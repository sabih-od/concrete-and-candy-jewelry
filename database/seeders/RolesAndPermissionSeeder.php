<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Create permissions
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-products']);

        // Assign permissions to roles
        Role::findByName('admin')->givePermissionTo(['manage-users', 'manage-products']);
    }
}
