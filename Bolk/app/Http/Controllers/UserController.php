<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
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

            $user = User::where('name', '=', $request->name)->first();

            error_log($user);

            //if (!Role::whereId($user->id)){
//            $role = new Role();
//            $role->id = $user->id;
//            $role->name = $user->name;
//            $role->save();
            $user->attachRole(intval($user->id));
            //}

            $role = Role::whereId($user->id)->first();
            error_log($role);
            $permissions = $request->permissions;
            error_log('did permissions');
            $role->attachPermissions($permissions);

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
            error_log('Do things');
            $this->checkInput($user, $request);
            error_log('Returned user: '.$user);
            $user->save();

            $user = User::whereId($id)->first();
            error_log('Found user '.$user);

//            if (!(Role::whereId($user->id)->first()).isEmptyOrNullString()){
//                error_log('Nog geen log');
//                $role = new Role();
//                error_log($role);
//                $role->id = $user->id;
//                $role->name = $user->name;
//                $role->display_name = $user->fullname;
//                error_log($role);
//                $role->saveOrFail();
//                error_log('Saved '.$role);
//                $user->attachRole($role);
//            }

            error_log('Roles: '.$user->roles);

            $role = Role::whereId($user->id)->first();
            error_log($role);
            $permissions = $request->permissions;
            error_log('did permissions');
            $role->attachPermissions($permissions);
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
