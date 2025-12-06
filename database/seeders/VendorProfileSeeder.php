<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->banner = 'uploads/1124.jpg';
        $vendor->shop_name = 'shop name';
        $vendor->phone = '9090909909';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'India';
        $vendor->description = 'Lorem ipsum';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
