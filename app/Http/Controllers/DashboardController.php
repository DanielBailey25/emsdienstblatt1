<?php

namespace App\Http\Controllers;

use App\Models\CurrentWorker;
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
        $currentWorker = $this->getActiveWorker();
        return view('dashboard', ['currentWorker' => $currentWorker]);
    }

    public function getActiveWorker() {
        return CurrentWorker::where(['ended_at' => null, 'client_id' => Auth::user()->client_id])->get();
    }
}
