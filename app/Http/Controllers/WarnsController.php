<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Warn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarnsController extends Controller
{
    public function show() {
        $warns = Warn::has('user');
        return view('user_warns', ['warns' => $warns]);
    }

    public function showForm($userId) {
        $warnedUser = User::find($userId);
        return view('create_user_warn', ['warnedUser' => $warnedUser]);
    }

    public function create(Request $request) {
        $request->validate([
            'warned_user' => 'required|exists:users,id',
            'content' => 'required|min:0|max:500'
        ]);

        Warn::create(
            [
                'warned_user_id' => $request->warned_user,
                'content' => $request->content,
                'created_by_user_id' => Auth::user()->id,
            ]
        );

        Notification::create([
            'title' =>  'Du wurdest von einem Admin verwarnt',
            'content' => $request->content . '

            Wende dich an die Leitungsebene um dies gegebenfalls zu klären.',
            'created_by_user_id' => Auth::user()->id,
            'notified_user_id' => $request->warned_user,
        ]);
        return redirect()->route('showWarns')->with('message', 'Die Verwarnung wurde erfolgreich erstellt.');
    }

    public function delete($id) {
        $warn = Warn::find($id);

        if($warn) {
            $warn->delete();
            return redirect()->route('showWarns')->with('message', 'Die Verwarnung wurde erfolgreich gelöscht.');
        }
    }
}
