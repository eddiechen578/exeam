<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Permission;
use App\Entities\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::all();
        return view('admin.role.index')
              ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $permissions = Permission::all();
       return view('admin.role.create')
             ->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->slug = str_slug($request->name);
        $role->save();
        foreach($request->permissions as $permission){
            $permission = Permission::where('id', $permission)->first();
            $role->permissions()->attach($permission);
        }
        return redirect()->route('roles.index')
              ->with('success', '角色新增成功.');
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
    public function edit(Role $role)
    {
        return view('admin.role.edit')
               ->with('role', $role)
               ->with('permissions', Permission::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
          $role->update([
             'name' => $request->name,
             'slug' => str_slug($request->name)
          ]);

          foreach($role->permissions as $permission){
              $role->permissions()->detach($permission);
          }

        foreach($request->permissions as $permission){
            $permission = Permission::where('id', $permission)->first();
            $role->permissions()->attach($permission);
        }
        return redirect()->route('roles.index')
            ->with('success', '角色更新成功.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        foreach($role->permissions as $permission){
            $role->permissions()->detach($permission);
        }
        $role->delete();
    }

    public function getRoles(){

        $roles = Role::all();
        return response()->json($roles, 200);
    }
}
