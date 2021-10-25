<?php

namespace App\Http\Controllers;

use App\Models\ToBeConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToBeConfirmedController extends Controller
{
    public function showToBeConfirmed() {
        $confirmations = ToBeConfirmed::where('is_confirmed', null)->where('client_id', Auth::user()->client_id)->get();

        return view('to_be_confirmed', ['confirmations' => $confirmations]);
    }

    public function acceptConfirmation($id) {
        $confirmation = ToBeConfirmed::find($id);
        if ($confirmation) {
            $confirmation->confirm();
        }
        return redirect()->route('showToBeConfirmed')->with('message', 'Die Namensänderung wurde bewilligt');
    }

    public function declineConfirmation($id) {
        $confirmation = ToBeConfirmed::find($id);
        if ($confirmation) {
            $confirmation->decline();
        }
        return redirect()->route('showToBeConfirmed')->with('info', 'Der Antrag wurde abgelehnt');
    }
}
