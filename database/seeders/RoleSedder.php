<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;  //modelo de lo roles
use Spatie\Permission\Models\Permission;  //modelo de los permisos

class RoleSedder extends Seeder
{
    /**
     * Admin  => la gestión de usuarios, gestión de los productos y gestión de roles.
     * Seller => la gestión de productos.
     * Custumer => la visualización y la edición de productos cuando realice la compra de los mismos.
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']); // Rol de Admin
        $seller = Role::create(['name' => 'seller']); // Rol de Seller
        $custumer = Role::create(['name' => 'custumer']); // Rol de Admin

                           //nombre de la ruta web
        Permission::create(['name' => 'dashboard'])->syncRoles([$admin, $seller, $custumer]);

                           //nombre de la ruta API
        Permission::create(['name' => 'showAllUser'])->assignRole($admin);
        Permission::create(['name' => 'updateRole'])->assignRole($admin);

        Permission::create(['name' => 'user'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'updateUser'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'deleteUser'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'logoutUser'])->syncRoles([$admin, $seller, $custumer]);

        Permission::create(['name' => 'store'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'store.search'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'store.pay'])->syncRoles([$admin, $seller, $custumer]);


        Permission::create(['name' => 'showAllProducts'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'searchOneProduct'])->syncRoles([$admin, $seller]);
        Permission::create(['name' => 'createProduct'])->syncRoles([$admin, $seller]);
        Permission::create(['name' => 'updateProduct'])->syncRoles([$admin, $seller]);
        Permission::create(['name' => 'DeleteProduct'])->syncRoles([$admin, $seller]);


        Permission::create(['name' => 'createInvoices'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'addContent'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'buyInvoices'])->syncRoles([$admin, $seller, $custumer]);
        Permission::create(['name' => 'showInvoices'])->syncRoles([$admin, $seller, $custumer]);
    }
}
