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
            'item_id.required' => 'Ein Ort muss ausgewählt werden.'
        ]);

        $currentWorkerForUser = $this->getCurrentWorkerForCurrentUser();

        if($currentWorkerForUser && $currentWorkerForUser->item_id == $request->input('item_id') && $currentWorkerForUser->state_id == $request->input('state_id')){
            return redirect()->route('home');
        }

        $this->stopCurrentWorkerForUser();

        $this->createCurrentWorker(Auth::user()->id, $request->input('item_id'), $request->input('description'), $request->input('state_id'));

        return redirect()->route('home');
    }

    public function createCurrentWorker($userId, $itemId, $description, $stateId) {
        $itemUsedBy = $this->itemUsedBy($itemId);
        if ($itemUsedBy) {
            $related_id = $itemUsedBy->id;
        }
        CurrentWorker::create([
            'user_id' => $userId,
            'client_id' => Auth::user()->client_id,
            'related_id' => $related_id ?? null,
            'description' => $description,
            'item_id' => $itemId,
            'state_id' => $stateId,
        ]);
    }

    public function stopWorker() {
        $this->stopCurrentWorkerForUser();
        return redirect()->route('home');
    }

    public function stopCurrentWorkerForUser() {
        $worker = $this->getCurrentWorkerForCurrentUser();
        if ($worker) {
            $worker->stopWorker();
        }
    }

    public function stopWorkerById($id) {
        $worker = CurrentWorker::find($id);
        if ($worker) {
            $worker->stopWorker();
        }
        return redirect()->route('home');
    }

    public function getCurrentWorkerForCurrentUser() {
        return CurrentWorker::where(['user_id'=> Auth::user()->id, 'ended_at'=> null])->first();
    }
    public function getCurrentWorkerByUserId($id) {
        return CurrentWorker::where(['user_id'=> $id, 'ended_at'=> null])->first();
    }

    public function itemUsedBy($itemId) {
        $worker = CurrentWorker::where(['item_id'=> $itemId, 'ended_at'=> null])->first();
        return $worker;
    }
}
