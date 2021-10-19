<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadeboardController extends Controller
{
    public function index() {
        return view('leaderboard');
    }
}
