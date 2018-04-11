<?php

namespace VendingDroid\Http\Controllers;

use Illuminate\Http\Request;

use VendingDroid\Http\Requests;
use VendingDroid\Http\Controllers\Controller;
use VendingDroid\Models\User;
use Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();
        return redirect('/user')->with('ok');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();
        return redirect('/user')->with('ok');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('ok');
    }

    public function getChangePassword()
    {
        // show page /resources/views/auth/changepassword
        return view('user.changepassword');
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('/home')->with('ok');
    }
}
