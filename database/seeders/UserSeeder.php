<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Role::where('slug','root')->first();
        $manager = Role::where('slug', 'mngr')->first();

        $createRecords = Permission::where('slug','create-records')->first();
        $manageRecords = Permission::where('slug','manage-records')->first();

        $user1 = new User();
        $user1->name = 'admin';
        $user1->email = 'admin@bk.ru';
        $user1->password = bcrypt('Admin1234');
        $user1->save();
        $user1->roles()->attach($root);
        $user1->permissions()->attach($createRecords);

        $user2 = new User();
        $user2->name = 'manager';
        $user2->email = 'manager.@gmail.com';
        $user2->password = bcrypt('Manager1234');
        $user2->save();
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($manageRecords);
    }
}
