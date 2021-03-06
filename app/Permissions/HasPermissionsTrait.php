<?php
namespace App\Permissions;

use App\Entities\Permission;
use App\Entities\Role;

trait HasPermissionsTrait{

    public function roles(){
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function hasRole( ... $permission){
       return $this->hasRoleThroughPermission($permission);
//        foreach($roles as $role){
//            if($this->roles->contains('slug', $role)){
//                return true;
//            }
//        }
//        return false;
    }

    public function hasRoleThroughPermission($permission){
        $p = Permission::where('name', $permission)->first();

        foreach($p->roles as $role){
            if($this->roles->contains($role)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission) {
        return $this->hasPermissionThroughRole($permission);
    }

    public function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function givePermissionsTo(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);

        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function deletePermissions( ... $permissions ) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

}