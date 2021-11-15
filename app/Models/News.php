<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'expire_at',
        'news_category_id',
        'creator_id',
        'is_important',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function readableStartedAt() {
        return Carbon::parse($this->created_at)->timezone('Europe/Stockholm')->isoFormat('DD.MM.YYYY HH:mm');
    }
}
