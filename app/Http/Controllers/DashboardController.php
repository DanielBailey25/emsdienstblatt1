<?php

namespace App\Http\Controllers;

use App\Models\CurrentWorker;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $currentWorkerCount = $currentWorker->count();
        $maxWorkerCount = $this->getCountActiveWorkers();
        $medicalDepartments = $this->getItemsByType(1);

        return view('dashboard', [
            'currentWorker' => $currentWorker,
            'currentWorkerCount' => $currentWorkerCount,
            'maxWorkerCount' => $maxWorkerCount,
            'medicalDepartments' => $medicalDepartments,
        ]);
    }

    public function getActiveWorkerWithoutRelation() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id, 'related_id' => null])->get();
    }

    public function getCountActiveWorkers() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id, ])->count();
    }

    public function getItemsByType($typeId) {
        return Item::where(['client_id' => Auth::user()->client_id, 'item_type_id' => $typeId])->get();
    }

    public function switchItemClosedState(Request $request) {
        $itemId = $request->input('item_id');
        $isClosed = $request->input('is_closed');

        $item = Item::where('id', $itemId)->first();
        $item->is_closed = !$isClosed;
        $item->save();

        return redirect()->route('home');
    }
}
