<?php

namespace App\Http\Controllers;

use App\Models\IdleWarn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdleWarnController extends Controller
{
    public function index(){
        $warn = IdleWarn::where([
            'warned_user_id' => Auth::user()->id,
            'seen' => false,
        ])->first();
        if ($warn) {
            return view('idle_warn');
        }
        return redirect()->route('home');
    }

    public function markAsSeen() {
        $warn = IdleWarn::where([
            'warned_user_id' => Auth::user()->id,
            'seen' => false,
        ])->first();
        if ($warn) {
            $warn->seen = true;
            $warn->save();
            return redirect()->route('home')->with('message', 'Du bleibst eingetragen.');
        }
        return redirect()->route('home');
    }
}
