<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'created_by_user_id',
        'notified_user_id',
        'notified_role',
        'title',
        'isNews',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by_user_id')->first();
    }

    public function readableCreatedAt() {
        return Carbon::now()->timezone('Europe/Stockholm')->isoFormat('DD.MM.YYYY HH:mm');
    }

    public function isNotifiedUser() {
        if ($this->notified_user_id == Auth::user()->id) {
            return true;
        }
        return false;
    }

    public function isNotifiedUserRole() {
        if ($this->notified_role != null && User::find(Auth::user()->id)->hasRole($this->notified_role)) {
            return true;
        }
        return false;
    }

    public function isPublic() {
        if ($this->notified_user_id == null && $this->notified_role == null) {
            return true;
        }
        return false;
    }
}
