<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function index() {
        $events = Event::where('receiver_id', Auth::user()->id)->get();

        return view('events', ['events' => $events]);
    }
}
