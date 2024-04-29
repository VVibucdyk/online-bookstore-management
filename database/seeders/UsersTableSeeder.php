<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.co',
                'password' => Hash::make('admin123'), // Replace 'your_password_here' with the desired password
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Mansuia Biasa',
                'email' => 'customer@test.net',
                'password' => Hash::make('customer123'), // Replace 'another_password_here' with the desired password
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more user data as needed
        ]);
    }
}
