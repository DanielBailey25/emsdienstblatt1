<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'datetime',
        'location',
        'is_accepted',
    ];

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
