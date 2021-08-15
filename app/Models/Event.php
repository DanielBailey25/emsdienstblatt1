<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
