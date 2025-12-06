<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'kushwahamanish956541@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->banner = 'uploads/1124.jpg';
        $vendor->shop_name = 'shop name';
        $vendor->phone = '9090909909';
        $vendor->email = 'kushwahamanish956541@gmail.com';
        $vendor->address = 'India';
        $vendor->description = 'Lorem ipsum';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
