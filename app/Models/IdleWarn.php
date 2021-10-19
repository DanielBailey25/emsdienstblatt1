<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdleWarn extends Model
{
    use HasFactory;

    protected $fillable = [
        'seen',
        'warned_user_id',
    ];
}
