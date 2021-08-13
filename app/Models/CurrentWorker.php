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
        'description',
        'started_at',
        'ended_at',
    ];

    public function stopWorker() {
        $this->ended_at = Carbon::now()->toDateTimeString();
        $this->save();
    }
}
