<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
                // roles
                Role::create(['name' => "admin"]);
                Role::create(['name' => "user"]);
                Role::create(['name' => "manager"]);
                // permissions
                Permission::create(['name' => "approveResturant"]);
                Permission::create(['name' => "deleteResturant"]);
                Permission::create(['name' => "updateResturant"]);
                Permission::create(['name' => "createResturant"]);
                // assign role to permission
                $role = Role::findByName('admin');
                $role->givePermissionTo(Permission::all());
                


    }
}