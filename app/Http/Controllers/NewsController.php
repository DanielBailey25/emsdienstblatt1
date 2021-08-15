<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index() {
        $categories = NewsCategory::where('client_id', Auth::user()->client_id)->get();

        return view('news', ['categories' => $categories]);
    }
}
