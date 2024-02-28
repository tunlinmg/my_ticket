<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $productManager = Role::create(['name' => 'Product Manager']);
        $agent = Role::create(['name' => 'Agent']);
        $customer = Role::create(['name' => 'Customer']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $productManager->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $agent->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $customer->givePermissionTo([
            'create-product',
        ]);
    }
}