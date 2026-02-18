<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create(
            [
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'role_id'  => '1',
                'password' => Hash::make('password'),
            ]
        );

        User::create(
            [
                'name'     => 'User',
                'email'    => 'user@gmail.com',
                'role_id'  => '2',
                'password' => Hash::make('pwUser1'),
            ]
        );
    }
}
