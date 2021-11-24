<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        \App\Models\Role::create([
            'name' => 'admin',
        ]);

        \App\Models\Role::create([
            'name' => 'employee',
        ]);

        \App\Models\Outlet::create([
            'name' => 'admin',
            'address' => 'admin',
            'phone' => 'admin',
        ]);

        \App\Models\Outlet::create([
            'name' => 'outlet1',
            'address' => 'alskfhlashf',
            'phone' => '128497120',
        ]);

        \App\Models\User::create([
            'role_id' => 1,
            'outlet_id' => 1,
            'name' => 'Admin',
            'email' => 'adm@cec.id',
            'password' => bcrypt('123123123'),
            'phone' => '088800008888',
            'active' => 1,
        ]);

        \App\Models\User::create([
            'role_id' => 2,
            'outlet_id' => 2,
            'name' => 'Employee',
            'email' => 'emp@cec.id',
            'password' => bcrypt('123123123'),
            'phone' => '088800008888',
            'active' => 1,
        ]);
    }
}
