<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class TrainingsController extends Controller
{
    public function createTrainingView() {
        return view('create_training');
    }

    public function createTraining(Request $request) {
        $request->validate([
            'title' => 'required',
            'url' => 'required | url',
        ],[], [
            'title' => 'Titel',
            'url' => 'iFrame-URL',
        ]);

        Training::create([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'client_id' => Auth::user()->client_id,
        ]);

        return redirect()->route('createTraining')->with('message', 'Der Ausbildungskurs wurde erfolgreich erstellt');
    }

    public function unlockTrainingView() {
        $users = User::where('client_id', Auth::user()->client_id)->get()->sortBy('rank');

        return view('assign_user_to_training', ['users' => $users]);
    }

    public function unlockTrainingForUsers(Request $request) {
        $request->validate([
            'users' => 'required',
            'training' => 'required',
        ], [], [
            'users' => 'Mitarbeiter'
        ]);
        foreach($request->input('users') as $userId) {
            $user = User::find($userId);
            $permission = Permission::firstOrCreate(['name' => 'call training_' . $request->input('training')]);
            if (!$user->hasPermissionTo($permission)){
                $user->givePermissionTo($permission);
            }
        }
        return redirect()->route('unlockTrainingView')->with('message', 'Der Ausbildungskurs wurde für die ausgewählten Benutzer freigegeben.');
    }

    public function showTraining($id) {
        try {
            if (User::find(Auth::user()->id)->hasPermissionTo('call training_' . $id)) {
                return view('training', ['training' => Training::find($id)]);
            }
        } catch(Exception $e) {

        }
        return redirect()->route('home');
    }
}
