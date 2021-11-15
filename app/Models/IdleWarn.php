<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdleWarn extends Model
{
    use HasFactory;

    protected $fillable = [
        'seen',
        'warned_user_id',
    ];

    public function readableNow() {
        return Carbon::now()->timezone('Europe/Stockholm')->isoFormat('DD.MM.YYYY HH:mm');
    }
}
