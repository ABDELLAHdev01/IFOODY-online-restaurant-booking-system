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
                // manger permissions
                Permission::create(['name' => "CreateTable"]);
                Permission::create(['name' => "UpdateTable"]);
                Permission::create(['name' => "DeleteTable"]);
                Permission::create(['name' => "CreateReservation"]);
                Permission::create(['name' => "UpdateReservation"]);
                Permission::create(['name' => "DeleteReservation"]);
                Permission::create(['name' => "AcceptReservation"]);
                Permission::create(['name' => "RejectReservation"]);
                Permission::create(['name' => "CreateOrder"]);
                Permission::create(['name' => "UpdateOrder"]);
                Permission::create(['name' => "DeleteOrder"]);
                Permission::create(['name' => "AcceptOrder"]);
                Permission::create(['name' => "RejectOrder"]);
                Permission::create(['name' => "CreateBill"]);
                Permission::create(['name' => "UpdateBill"]);
                Permission::create(['name' => "DeleteBill"]);
                // user permissions
                Permission::create(['name' => "makeReservation"]);
                Permission::create(['name' => "UpdateHisReservation"]);
                Permission::create(['name' => "DeleteHisReservation"]);
                Permission::create(['name' => "CreateHisOrder"]);
                Permission::create(['name' => "UpdateHisOrder"]);
                Permission::create(['name' => "DeleteHisOrder"]);
                Permission::create(['name' => "CreateHisBill"]);
                Permission::create(['name' => "UpdateHisBill"]);
                Permission::create(['name' => "DeleteHisBill"]);

                // assign role to permission
                $role = Role::findByName('admin');
                $role->givePermissionTo(Permission::all());
                // assign some roles to manger
                $role2 = Role::findByName('manager');
                $role2->givePermissionTo(['CreateTable','UpdateTable','DeleteTable','CreateReservation','UpdateReservation','DeleteReservation','AcceptReservation','RejectReservation','CreateOrder','UpdateOrder','DeleteOrder','AcceptOrder','RejectOrder','CreateBill','UpdateBill','DeleteBill']);
                // assign some roles to user
                $role3 = Role::findByName('user');
                $role3->givePermissionTo(['CreateReservation','UpdateReservation','DeleteReservation','CreateOrder','UpdateOrder','DeleteOrder','CreateBill','UpdateBill','DeleteBill']);




    }
}