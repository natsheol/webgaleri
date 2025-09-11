<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@hogwarts.com'],
            [
                'name' => 'Hogwarts Admin',
                'password' => Hash::make('password123'), // ganti kalau mau aman
                'is_admin' => true
            ]
        );
    }
}
