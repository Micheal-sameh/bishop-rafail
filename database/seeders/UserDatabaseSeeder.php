<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '01000000000',
            'password' => Hash::make('password'),
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
