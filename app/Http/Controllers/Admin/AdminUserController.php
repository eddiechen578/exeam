<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Role;
use App\User;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use App\Http\Controllers\Controller;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', \App\User::ADMIN_TYPE)->get();

        return view('admin.adminUser.index')
              ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.adminUser.create')
              ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type  = User::ADMIN_TYPE;
        $user->save();

        $roles = explode(',', $request->roles);
        foreach($roles as $role)
        {
            $give_role = Role::where('slug', $role)->first();
            $user->roles()->attach($give_role);
        }
        return redirect()->route('adminUsers.index')
              ->with('success', '管理者新增成功.');
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
        $user = User::find($id);

        $roles  = "";

        foreach($user->roles as $role){
            $roles .= $role->slug.',';
        }
        $roles = substr($roles,0,-1);

        return view('admin.adminUser.edit')
             ->with('user', $user)
             ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, $id)
    {
        $user = User::find($id);

        $check = $this->passwordCorrect($request->password, $user);
        dd($check);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $roles = explode(',', $request->roles);

        foreach($user->roles as $role){
            $user->roles()->detach($role);
        }

        foreach($roles as $role)
        {
          $give_role = Role::where('slug', $role)->first();
          $user->roles()->attach($give_role);
        }
        return redirect()->route('adminUsers.index')
                        ->with('success', '管理者更新成功.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        foreach($user->roles as $role){
            $user->roles()->detach($role);
        }
        $user->delete();

        return redirect()->back()
              ->with('success', '用戶刪除成功.');
    }

    private function passwordCorrect($suppliedPassword, $user)
    {
        return Hash::check('1111', $user->password, []);
    }
}
