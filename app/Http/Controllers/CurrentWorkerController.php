<?php

namespace App\Http\Controllers;

use App\Models\CurrentWorker;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentWorkerController extends Controller
{

    public function index() {
        $itemTypes = ItemType::where('client_id', Auth::user()->client_id)->get();
        $states = State::where('client_id', Auth::user()->client_id)->get();

        return view('startworker', ['itemTypes' => $itemTypes, 'states' => $states]);
    }

    public function startWorker(Request $request) {
        $request->validate([
            'state_id' => 'required',
            'item_id' => 'required',
        ],[
            'item_id.required' => 'Ein Auto oder Gebäude muss ausgewählt werden.'
        ]);

        $this->userHaveWorkerAndStop();
        $itemUsedBy = $this->itemUsedBy($request->input('item_id'));
        if ($itemUsedBy) {
            $related_id = $itemUsedBy->id;
        }
        CurrentWorker::create([
            'user_id' => Auth::user()->id,
            'client_id' => Auth::user()->client_id,
            'related_id' => $related_id ?? null,
            'description' => $request->input('description'),
            'item_id' => $request->input('item_id'),
            'state_id' => $request->input('state_id'),
        ]);
        return redirect()->route('home');
    }

    public function stopWorker() {
        $this->userHaveWorkerAndStop();
        return redirect()->route('home');
    }

    public function userHaveWorkerAndStop() {
        $worker = CurrentWorker::where(['user_id'=> Auth::user()->id, 'ended_at'=> null])->first();
        if ($worker) {
            $worker->stopWorker();
        }
    }

    public function itemUsedBy($itemId) {
        $worker = CurrentWorker::where(['item_id'=> $itemId, 'ended_at'=> null])->first();
        return $worker;
    }
}
