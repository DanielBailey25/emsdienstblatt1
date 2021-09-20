<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BansController extends Controller
{
    public function index() {
        $bans = Ban::whereDate('to', '>', Carbon::now())->get();
        return view('bans', ['bans' => $bans]);
    }
}
