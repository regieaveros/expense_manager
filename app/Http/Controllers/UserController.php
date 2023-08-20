<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_role = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.display_name as role_name')
            ->get();

        return response()->json($users_role);
    }

    public function profile_index()
    {
        $auth = Auth::user();
        return response()->json($auth);
    }

    public function user_permission()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => 'required|confirmed|min:6',
            'role_id' => 'required',
        ]);

        $role = new User();
        $role->name = $request['name'];
        $role->email = $request['email'];
        $role->password = Hash::make($request['password']);
        $role->role_id = $request['role_id'];
        $role->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function profile_update($id, Request $request, User $user)
    {
        if ($request->toggle) {
            $request->validate([
                'name' => 'required',
                'email' => ['required', 'email'],
                'password' => 'required|confirmed|min:6',
            ]);

            $user->where('id', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => ['required', 'email'],
            ]);

            $user->where('id', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
        }

        Auth::logout();
    }

    public function update($id, Request $request, User $user)
    {
        if ($request->toggle) {
            $request->validate([
                'name' => 'required',
                'email' => ['required', 'email'],
                'password' => 'required|confirmed|min:6',
                'role_id' => 'required',
            ]);

            $user->where('id', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => $request->input('role_id')
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => ['required', 'email'],
                'role_id' => 'required',
            ]);

            $user->where('id', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role_id' => $request->input('role_id')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, User $user)
    {
        $user->where('id', $id)->delete();
    }
}
