<?php

namespace App\Http\Controllers;

use App\Models\CurrentWorker;
use App\Models\Item;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentWorkerController extends Controller
{

    public function index() {
        $items = Item::where('client_id', Auth::user()->client_id)->get();
        $states = State::where('client_id', Auth::user()->client_id)->get();
        return view('startWorker', ['items' => $items, 'states' => $states]);
    }

    public function startWorker(Request $request) {
        $this->checkIfUserHaveWorkerAndStop();
        CurrentWorker::create([
            'user_id' => Auth::user()->id,
            'description' => $request->input('description'),
            'item_id' => $request->input('item_id'),
            'state_id' => $request->input('state_id'),
        ]);
        return redirect()->route('home');
    }

    public function checkIfUserHaveWorkerAndStop() {
        $worker = CurrentWorker::where(['user_id'=> Auth::user()->id, 'ended_at'=> null])->first();
        if ($worker) {
            $worker->stopWorker();
        }
    }
}
