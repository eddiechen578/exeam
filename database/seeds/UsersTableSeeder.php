<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Entities\Role;
use App\Entities\Permission;
class UsersTableSeeder extends Seeder
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
//        $dev_perm = Permission::where('slug','create-tasks')->first();
//        $manager_perm = Permission::where('slug','edit-users')->first();

        $developer = new User();
        $developer->name = 'Admin';
        $developer->email = 'usama@thewebtier.com';
        $developer->password = bcrypt('1111');
        $developer->type = \App\User::ADMIN_TYPE;
        $developer->save();

        $manager = new User();
        $manager->name = 'Admin2';
        $manager->email = 'asad@thewebtier.com';
        $manager->password = bcrypt('1111');
        $manager->type = \App\User::ADMIN_TYPE;
        $manager->save();

    }
}
