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

    public function stopWorker() {
        $this->ended_at = Carbon::now()->toDateTimeString();
        $this->save();
    }

    public function item() {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function related() {
        return $this->hasMany(self::class, 'related_id');
    }

    public function readableStartedAt() {
        return Carbon::parse($this->started_at)->diffForHumans();
    }
}
