<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);


        factory(\App\Entities\Category::class, 3)->create()->each(function ($c){
            $c->products()
              ->saveMany(
                 factory(\App\Entities\Product::class, 3)->make()
                 );
        });
    }
}
