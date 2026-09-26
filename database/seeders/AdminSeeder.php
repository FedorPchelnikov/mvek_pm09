<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    // УЗ админа
    public function run(): void
    {
        User::updateOrCreate(
            ['login' => 'Admin2026'],
            [
                'name' => 'Администратор портала',
                'phone' => '+7 (000) 000-00-00',
                'email' => 'admin@banquetam.net',
                'password' => 'Admin2026',
                'is_admin' => true,
            ],
        );
    }
}
