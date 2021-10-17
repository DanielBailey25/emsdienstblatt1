<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use App\Models\CurrentWorker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function users() {
        $users = User::where('client_id', Auth::user()->client_id)->orderBy('name', 'asc')->get();
        $roles = Role::all();

        return view('users', ['users' => $users, 'roles' => $roles]);
    }

    public function addUserView() {
        $users = User::where('client_id', Auth::user()->client_id)->get();
        $roles = Role::all();

        return view('forms.add_user', ['users' => $users, 'roles' => $roles]);
    }

    public function createUser(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|min:6',
            'rank' => 'required|integer|min:0|max:12',
            'player_id' => 'required|integer|unique:users,player_id,id',
            'phone' => 'nullable|regex:/\d{2}-\d{2}-\d{3}/',
            'role' => 'required',
        ],[], [
            'name' => 'Name',
            'password' => 'Passwort',
            'rank' => 'Rank',
            'player_id' => 'Einreise-ID',
            'phone' => 'Telefonnummer',
        ]);

        $user = User::create(
        [
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'rank' => $request->input('rank'),
            'player_id' => $request->input('player_id'),
            'phone' => $request->input('phone'),
            'client_id' => Auth::user()->client_id,
        ]);
        try {
            $user->assignRole($request->input('role'));
        } catch (Exception $e) {
            $user->delete();
            $errors = new MessageBag();

            // add your error messages:
            $errors->add('user_creation_failed', 'Beim erstellen des Benutzers ist ein Fehler aufgetreten. Bitte kontaktieren Sie einen Systemadministrator.');
            return redirect()->route('users')->withErrors($errors);
        }

        return redirect()->route('users')->with('message', 'Der Nutzer ' . $request->input('name') . ' wurde erfolgreich erstellt.');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'old_pw' => 'required|password',
            'new_pw' => 'required|min:6',
            'repeat_new_pw' => 'required|same:new_pw',
        ],[], [
            'new_pw' => 'Neues Passwort',
            'repeat_new_pw' => 'Neues Passwort wiederholen'
        ]);

        $request->user()->password = Hash::make($request->new_pw);
        $request->user()->save();
        return redirect()->route('profile')->with('message', 'Dein Passwort wurde erfolgreich geändert');
    }

    public function changeInformation(Request $request) {
        $request->validate([
            'phone' => 'required|regex:/\d{2}-\d{2}-\d{3}/|min:9',
        ]);

        $request->user()->phone = $request->phone;
        $request->user()->save();
        return redirect()->route('profile')->with('message', 'Deine Telefonnummer wurde erfolgreich geändert');
    }

    public function changeRole(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($request->user_id);

        try {
            $user->syncRoles($request->input('role'));
        } catch (Exception $e) {
            throw $e;
        }
        $user->save();
    }

    public function removeUser($id) {
        if ($id == Auth::user()->id){
            $errors = new MessageBag();
            $errors->add('user_delete_failed', 'Du kannst dich nicht selber löschen...');
            return redirect()->route('users')->withErrors($errors);
        }
        $user = User::find($id);

        if ($user->is_admin) {
            $errors = new MessageBag();
            $errors->add('user_delete_failed_admin', 'Du kannst deinen Erschaffer nicht stürzen!');
            return redirect()->route('users')->withErrors($errors);
        }
        $currentWorker = CurrentWorker::where(['user_id'=> $id, 'ended_at'=> null])->first();
        if ($currentWorker) {
            $currentWorker->stopWorker();
        }
        $user->delete();
        return redirect()->route('users')->with('message', $user->name . ' wurde erfolgreich gelöscht.');
    }

    public function increaseRank($id) {
        $user = User::find($id);
        if (!$user || $user->rank >= 12) {
            return redirect()->route('users');
        }
        $user->increment('rank', 1);
        return redirect()->route('users')->with('message', $user->name . ' wurde auf Rang ' . $user->rank . ' angehoben.');
    }

    public function decreaseRank($id) {
        $user = User::find($id);
        if (!$user || $user->rank <= 0) {
            return redirect()->route('users');
        }
        $user->decrement('rank', 1);
        return redirect()->route('users')->with('message', $user->name . ' wurde auf Rang ' . $user->rank . ' herabgesenkt.');
    }
}
