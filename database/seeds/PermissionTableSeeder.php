<?php

use Illuminate\Database\Seeder;
use App\Entities\Role;
use App\Entities\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $dev_role = Role::where('slug','developer')->first();
//        $manager_role = Role::where('slug', 'manager')->first();

        $createTasks = new Permission();
        $createTasks->slug = 'create-merchandise';
        $createTasks->name = 'Create Product';
        $createTasks->save();

        $createTasks = new Permission();
        $createTasks->slug = 'view-user';
        $createTasks->name = 'View User';
        $createTasks->save();


//        $editUsers = new Permission();
//        $editUsers->slug = 'edit-users';
//        $editUsers->name = 'Edit Users';
//        $editUsers->save();
//        $editUsers->roles()->attach($manager_role);
    }
}
