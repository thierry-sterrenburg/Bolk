<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;
use Illuminate\Routing\Redirector;
use DB;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create() {
        return view('users.edit', ['state' => 'Create', 'user' => new User()]);
    }

    public function store(Request $request) {
        if ($request->ajax()) {
            $user = New User();
            $this->checkInput($user, $request);
            //if (!(User::find($request->email)->first())) {
                $user->save();
            //}
            return redirect()->route('users.index');
        }
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $user = User::whereId($id)->first();
        return view('users.edit', ['state' => 'Edit', 'user' => $user]);
    }

    public function update(Request $request, $id) {
        if ($request->ajax()) {
            $user = User::whereId($id)->first();
            $this->checkInput($user, $request);
            $user->save();
        }
    }

    public function destroy($id) {
        User::destroy($id);
    }

    public function checkInput($user, $request) {
        if ($request->name == '' || $request->email == ''){
            return null;
        } else {
            $user->name = $request->name;
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            if ($request->project == '0') {
                $user->projectid = null;
            } else {
                $user->projectid = $request->project;
            }
            if ($request->password != '') {
                $user->password = bcrypt($request->password);
            }
        }
        return $user;
    }


    //
}
