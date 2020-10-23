<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    //
    public function index() {
        
    }

    public function add() {
        
    }

    public function edit() {
        $currUser = \App\User::where('id', Auth::id())->first();
        return view('users.edit', compact('currUser'));
    }

    public function change(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:30'
        ]);
        
        $user = \App\User::where('id', Auth::id())->first();
        $user->name = Input::get('name');
        $user->save();
        
        return redirect('/');
    }

}
