<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::count();
        if($permissions <= 0){
            Permission::create(['name' => 'dashboard']);
            Permission::create(['name' => 'users']);
            Permission::create(['name' => 'clients']);
            Permission::create(['name' => 'villes']);
            Permission::create(['name' => 'stations']);
            Permission::create(['name' => 'evenements']);
            Permission::create(['name' => 'satisfactions']);
            Permission::create(['name' => 'tickets']);
            Permission::create(['name' => 'roles']);
            Permission::create(['name' => 'qr_code']);
        }
    }
}
