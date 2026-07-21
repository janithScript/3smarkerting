<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DistributorHead;

class DistributorHeadSeeder extends Seeder
{
    public function run(): void
    {
        DistributorHead::create([
            'head_name' => 'John Doe',
            'phone_number' => '+1234567890',
        ]);
    }
}
