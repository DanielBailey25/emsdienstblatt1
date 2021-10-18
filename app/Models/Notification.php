<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'created_by_user_id',
        'title',
        'isNews',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by_user_id')->first();
    }

    public function readableCreatedAt() {
        return Carbon::parse($this->created_at)->timezone('Europe/Stockholm')->isoFormat('DD.MM.YYYY HH:mm');
    }
}
