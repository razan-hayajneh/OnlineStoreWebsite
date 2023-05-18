<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'superadmin',
                'email' => 'superadmin@OnlineStore.com',
                'password' => Hash::make('admin'),
                'phone' =>'123456'
            ],
        ];

        User::insert($data);
    }
}
