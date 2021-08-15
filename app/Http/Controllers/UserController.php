<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function users() {
        $users = User::where('client_id', Auth::user()->client_id)->get();
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
            'name' => 'required | unique:users',
            'password' => 'required | min:6',
            'rank' => 'required | integer',
            'service_number' => 'required | integer | unique:users,service_number,id',
            'phone' => 'nullable | integer',
            'role' => 'required',
        ],[], [
            'name' => 'Name',
            'password' => 'Passwort',
            'rank' => 'Rank',
            'service_number' => 'Dienstnummer',
            'phone' => 'Telefonnummer',
        ]);

        $user = User::create(
        [
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'rank' => $request->input('rank'),
            'service_number' => $request->input('service_number'),
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
}
