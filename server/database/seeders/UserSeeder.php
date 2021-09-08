<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'       => 'Admin',
            'email'      => 'admin@admin.com',
            'password'   => 'secret',
            'created_at' => now(),
            'updated_at' => now(),
            'role'       => 'admin',
            'deposit'   =>100000,
            'mobile_no' =>'01523698547',
            'account_type' => 'company',
            'nid_no' => '2547896541',
            'vat_no' => '1154789658'
            ]);

        User::create([
            'name'       => 'Bidder',
            'email'      => 'bidder@bidder.com',
            'password'   => 'secret',
            'created_at' => now(),
            'updated_at' => now(),
            'role'       => 'bidder',
            'deposit'   =>100000,
            'mobile_no' =>'01523698547',
            'account_type' => 'company',
            'nid_no' => '2547896541',
            'vat_no' => '1254489658'
        ]);
        User::create([
            'name'       => 'Karim',
            'email'      => 'karimr@bidder.com',
            'password'   => 'secret',
            'created_at' => now(),
            'updated_at' => now(),
            'role'       => 'bidder',
            'deposit'   =>120000,
            'mobile_no' =>'01523698547',
            'account_type' => 'company',
            'nid_no' => '2547896541',
            'vat_no' => '1254789655'
        ]);
        User::create([
            'name'       => 'Rahim',
            'email'      => 'rahim@bidder.com',
            'password'   => 'secret',
            'created_at' => now(),
            'updated_at' => now(),
            'role'       => 'bidder',
            'deposit'   =>150000,
            'mobile_no' =>'01523698547',
            'account_type' => 'company',
            'nid_no' => '2547896541',
            'vat_no' => '1254789658'
        ]);
    }
}
