<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageRecords = new Permission();
        $manageRecords->name = 'Изменение записей';
        $manageRecords->slug = 'manage-records';
        $manageRecords->save();

        $createRecords = new Permission();
        $createRecords->name = 'Создание записей';
        $createRecords->slug = 'create-records';
        $createRecords->save();
    }
}
