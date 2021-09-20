<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {
        $events = Event::where('receiver_id', Auth::user()->id)->orWhere('sender_id', Auth::user()->id)->get();

        return view('events', ['events' => $events]);
    }

    public function createEventView() {
        $users = User::where('client_id', Auth::user()->client_id)->where('id', '!=', Auth::user()->id)->get()->sortBy('name');

        return view('create_event', [
            'users' => $users,
        ]);
    }

    public function createEvent(Request $request) {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'date' => 'required | date | after:yesterday',
            'time' => 'required',
            'location' => 'nullable',
        ],[], ['receiver_id' => 'Empfänger']);

        Event::create([
                'receiver_id' => $request->input('receiver_id'),
                'sender_id' => Auth::user()->id,
                'datetime' => Carbon::parse($request->date . ' ' . $request->time),
                'location' => $request->input('location'),
        ]);

        return redirect()->route('events')->with('message', 'Dein Termin wurde erfolgreich erstellt.');
    }
}
