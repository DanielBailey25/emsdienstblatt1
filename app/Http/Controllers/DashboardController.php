<?php

namespace App\Http\Controllers;

use App\Models\AssignedControlCenter;
use App\Models\CurrentWorker;
use App\Models\Item;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentWorker = $this->getActiveWorkerWithoutRelation();
        $maxWorkerCount = $this->getCountActiveWorkers();

        return view('dashboard', [
            'currentWorker' => $currentWorker,
            'maxWorkerCount' => $maxWorkerCount,
        ]);
    }

    public function getActiveWorkerWithoutRelation() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id, 'related_id' => null])->orderBy('id', 'desc')->get();
    }

    public function getCountActiveWorkers() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id, ])->count();
    }

    public function getItemsByType($typeId) {
        return Item::where(['client_id' => Auth::user()->client_id, 'item_type_id' => $typeId])->get();
    }

    public function getControlCentersByClientId() {
        return AssignedControlCenter::where('client_id', Auth::user()->client_id)->get();
    }

    public function switchItemClosedState(Request $request) {
        $itemId = $request->input('item_id');
        $isClosed = $request->input('is_closed');

        $item = Item::where('id', $itemId)->first();
        $item->is_closed = !$isClosed;
        $item->save();

        return redirect()->route('home');
    }

    public function centerChangeAssignment(Request $request) {
        $centerId = $request->input('center_id');

        $center = AssignedControlCenter::where('id', $centerId)->first();

        // Check if center is allready assigned to the curren user
        if ($center->user_id == Auth::user()->id) {
            // If thats the case, unassign the user from the center
            $center->user_id = null;
        } else {
            $center->user_id = Auth::user()->id;
        }
        $center->save();

        return redirect()->route('home');
    }
}
