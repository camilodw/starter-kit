<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roleAdmin      = Role::create(['name' => 'admin']);
        $roleSa         = Role::create(['name' => 'Super Admin']);
        $roleUser       = Role::create(['name' => 'user']);

        Permission::create(['name' => 'create role'])->syncRoles($roleAdmin, $roleSa);
        Permission::create(['name' => 'show role'])->syncRoles($roleAdmin, $roleSa);
        Permission::create(['name' => 'delete role'])->syncRoles($roleAdmin, $roleSa);
        Permission::create(['name' => 'edit role'])->syncRoles($roleAdmin, $roleSa);
        Permission::create(['name' => 'create user'])->syncRoles($roleAdmin, $roleSa);
        Permission::create(['name' => 'edit user'])->syncRoles($roleAdmin, $roleSa);
        Permission::create(['name' => 'show user'])->syncRoles($roleAdmin, $roleSa, $roleUser);
        Permission::create(['name' => 'delete user'])->syncRoles($roleAdmin, $roleSa);

    }
}
