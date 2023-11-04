<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = new Role();
        $root->name = 'Root';
        $root->slug = 'root';
        $root->save();

        $manager = new Role();
        $manager->name = 'Manager';
        $manager->slug = 'mngr';
        $manager->save();

        $scontent = new Role();
        $scontent->name = 'S. Content';
        $scontent->slug = 'sc';
        $scontent->save();

        $content = new Role();
        $content->name = 'Content';
        $content->slug = 'cnt';
        $content->save();
    }
}
