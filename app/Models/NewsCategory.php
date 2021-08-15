<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NewsCategory extends Model
{
    use HasFactory;

    public function getActiveRelatedNews() {
        return News::where(function($q) {
            $q->whereDate('expire_at', Carbon::now()->toDateTimeString())
              ->orWhere('expire_at', null);
        })->get();
    }
}
