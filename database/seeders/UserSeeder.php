<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'username' =>'adminuser',
                'email' => 'admin@gmail.com',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Vender User',
                'username' =>'vendoruser',
                'email' => 'vendor@gmail.com',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'User',
                'username' =>'user',
                'email' => 'user@gmail.com',
                'status' => 'active',
                'password' => bcrypt('password')
            ]
        ]);
    }
}
