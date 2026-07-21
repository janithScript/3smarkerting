<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanySetting;

class CompanySettingSeeder extends Seeder
{
    public function run(): void
    {
        CompanySetting::create([
            'company_email' => 'info@3smarketing.com',
            'phone_number' => '+1234567890',
            'whatsapp_number' => '+1234567890',
        ]);
    }
}
