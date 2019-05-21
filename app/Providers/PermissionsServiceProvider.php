<?php

namespace App\Providers;

use App\Entities\Permission;
use Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('roles', function ($permission){
            return auth()->check() && auth()->user()->hasRole($permission);
        });

        Permission::get()->map(function ($permission){
            Gate::define($permission->slug, function ($user) use ($permission){
                return $user->hasPermissionTo($permission);
            });
        });
    }
}
