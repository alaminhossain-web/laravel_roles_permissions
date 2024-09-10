<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $role =Role::create(['name' => 'super-admin']);

        $permission_data = [
            ['name' => 'create users'],
            ['name' => 'view users'],
            ['name' => 'edit users'],
            ['name' => 'delete users'],

            ['name' => 'create role'],
            ['name' => 'view roles'],
            ['name' => 'edit roles'],
            ['name' => 'delete roles'],

            ['name' => 'create permissions'],
            ['name' => 'view permissions'],
            ['name' => 'edit permissions'],
            ['name' => 'delete permissions'],

            ['name' => 'create articles'],
            ['name' => 'view articles'],
            ['name' => 'edit articles'],
            ['name' => 'delete articles'],


        ];


        foreach ($permission_data as $data) {
            $permission = Permission::create($data);
        }

        $role->syncPermissions(Permission::all());

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('1234'),
        ])->assignRole('super-admin');

       
    }
}
