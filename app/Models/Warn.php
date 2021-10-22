<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warn extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'created_by_user_id',
        'warned_user_id',
    ];

    public function warnedUser() {
        return $this->belongsTo(User::class, 'warned_user_id')->first();
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by_user_id')->first();
    }

    public function readableCreatedAt() {
        return Carbon::parse($this->created_at)->timezone('Europe/Stockholm')->isoFormat('DD.MM.YYYY HH:ss');
    }
}
