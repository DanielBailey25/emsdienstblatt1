<?php

namespace App\Http\Controllers;

use App\Models\CurrentWorker;
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
            $currentWorker = CurrentWorker::where(['user_id'=> Auth::user()->id, 'ended_at'=> null])->first();
            if ($currentWorker) {
                $currentWorker->stopWorker();
                CurrentWorker::create([
                    'user_id' => Auth::user()->id,
                    'client_id' => Auth::user()->client_id,
                    'related_id' => $currentWorker->related_id,
                    'description' => $currentWorker->description,
                    'item_id' => $currentWorker->item_id,
                    'state_id' => $currentWorker->state_id,
                ]);
            }
            return redirect()->route('home')->with('message', 'Du bleibst eingetragen.');
        }
        return redirect()->route('home');
    }
}
