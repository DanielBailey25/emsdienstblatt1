<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkersController extends Controller
{
    public function index() {
        $users = User::where('client_id', Auth::user()->client_id)->orderBy('rank', 'desc')->orderBy('name', 'asc')->get();
        return view('workers', ['workers' => $users]);
    }

    public function showInterns() {
        // show intern list
    }
}
