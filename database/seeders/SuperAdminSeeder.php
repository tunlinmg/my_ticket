<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin', 
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin1234')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Product Manager', 
            'email' => 'productmanager@gmail.com',
            'password' => Hash::make('productmanager1234')
        ]);
        $productManager->assignRole('Product Manager');

        // Creating Product agent User
        $agent = User::create([
            'name' => 'Mr Agent', 
            'email' => 'agent@allphptricks.com',
            'password' => Hash::make('agent1234')
        ]);
        $agent->assignRole('Agent');

        // Creating Product Customer User
        $customer = User::create([
            'name' => 'Mr Customer', 
            'email' => 'customer@allphptricks.com',
            'password' => Hash::make('customer1234')
        ]);
        $customer->assignRole('Customer');

    }
}