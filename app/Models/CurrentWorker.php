<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentWorker extends Model
{
    use HasFactory;

    protected $table = 'current_worker';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'item_id',
        'state_id',
        'client_id',
        'description',
        'related_id',
        'started_at',
        'ended_at',
    ];

    public function stopWorker($ended_at = null) {
        $warn = IdleWarn::where(['warned_user_id' => $this->user_id, 'seen' => false])->first();
        if ($warn) {
            $warn->seen = true;
            $warn->save();
        }
        $relatedWorker = CurrentWorker::where(['related_id' => $this->id, 'ended_at' => null])->get();

        // If one related current worker are available, make first one as starter.
        $relatedId = null;
        foreach ($relatedWorker as $worker) {
            $worker->related_id = $relatedId;
            $worker->save();
            if ($relatedId == null) {
                $relatedId = $worker->id;
            }
        }
        $this->ended_at = $ended_at ?? Carbon::now()->toDateTimeString();
        $this->save();
    }

    public function item() {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function related() {
        return CurrentWorker::where('related_id', $this->id)->where('ended_at', null)->get();
    }

    public function readableStartedAtDiff() {
        return Carbon::parse($this->started_at)->diffForHumans();
    }

    public function readableStartedAt() {
        return Carbon::parse($this->started_at)->isoFormat('DD.MM.YYYY HH:mm');
    }
}
