<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => ' Cedric Friscia', 
            'email' => 'cedricfriscia@gmail.com',
            'password' => Hash::make('ez2024')
        ]);

        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Syed Ahsan Kamal', 
            'email' => 'ahsan@allphptricks.com',
            'password' => Hash::make('ahsan1234')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Abdul Muqeet', 
            'email' => 'muqeet@allphptricks.com',
            'password' => Hash::make('muqeet1234')
        ]);
        $productManager->assignRole('Product Manager');

    
  
    }
}