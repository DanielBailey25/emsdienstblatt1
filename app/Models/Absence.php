<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'type',
        'user_id',
        'time_included',
        'absence_type_id',
        'approved_by_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy() {
        return $this->belongsTo(User::class, 'approved_by_id');
    }
}
