<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ToBeConfirmed extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'old_value',
        'new_value',
        'is_confirmed',
        'client_id',
        'request_user_id',
        'notification_id',
    ];

    public function confirm() {
        $this->setNewValue();
        $this->is_confirmed = true;
        $this->save();
    }

    public function setNewValue() {
        switch ($this->type) {
            case 1:
                $user = $this->requestUser();
                $user->name = $this->new_value;
                $user->save();

                $this->confirmed_by_user_id = Auth::user()->id;
                $this->is_confirmed = true;
                $this->save();

                Notification::create([
                    'title' => 'Namensänderung',
                    'content' => 'Deine Namensänderung wurde von einem Administrator bewilligt.
                    Du trägst jetzt deinen neuen Namen.',
                    'notified_user_id' => $user->id,
                ]);

                if ($notification = Notification::find($this->notification_id)) {
                    $notification->delete();
                }
                break;
            default:
                break;
        }
    }

    public function decline() {
        $this->is_confirmed = false;
        $this->confirmed_by_user_id = Auth::user()->id;
        $this->save();

        if ($notification = Notification::find($this->notification_id)) {
            $notification->delete();
        }

        if ($this->type == 1) {
            Notification::create([
                'title' => 'Namensänderung',
                'content' => 'Deine Namensänderung konnte nicht bewilligt werden.
                Versuche dies mit der Leitungsebene zu klären.',
                'notified_user_id' => $this->request_user_id,
            ]);
        }
    }

    public function requestUser() {
        return $this->belongsTo(User::class, 'request_user_id')->first();
    }

    public function readableCreatedAt() {
        return Carbon::parse($this->created_at)->timezone('Europe/Stockholm')->isoFormat('DD.MM.YYYY HH:mm');
    }

}
