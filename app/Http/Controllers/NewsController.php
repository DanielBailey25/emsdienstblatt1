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

    public function addNewsView() {
        $categories = NewsCategory::where('client_id', Auth::user()->client_id)->get();

        return view('add_news', ['newsCategories' => $categories]);
    }

    public function addNews(Request $request) {
        $request->validate([
            'category' => 'required | exists:news_categories,id',
            'title' => 'required | max:255',
            'content' => 'required | max:500',
        ]);

        News::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'creator_id' => Auth::user()->id,
            'news_category_id' => $request->input('category'),
        ]);

        return redirect()->route('addNews')->with('message', 'Die News wurden aktualisiert.');
    }
}
