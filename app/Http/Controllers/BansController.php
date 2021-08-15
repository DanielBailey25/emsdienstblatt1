<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BansController extends Controller
{
    public function index() {
        return view('bans');
    }
}
