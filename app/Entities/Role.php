<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function permissions(){
      return
      $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
