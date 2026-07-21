<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@3smarketing.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);
    }
}
