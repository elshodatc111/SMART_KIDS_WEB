<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void{
        // 1. Asosiy Admin foydalanuvchisini yaratish
        User::create([
            'name' => 'Adminstrator',
            'phone' => '+998901234567',
            'phone_two' => '',
            'address' => 'Toshkent sh., Chilonzor',
            'birthday' => '1990-01-01',
            'passport_number' => 'AA1234567',
            'type' => 'admin',
            'status' => 'active',
            'password' => Hash::make('password'), // Parol: password123
        ]);

        // 2. Direktor foydalanuvchisini yaratish
        User::create([
            'name' => 'Direktor Ismi',
            'phone' => '+998911234567',
            'type' => 'drektor',
            'status' => 'active',
            'password' => Hash::make('direktor'),
        ]);

        // 3. Test uchun yana bir nechta xodimlarni yaratish (Factory ishlatmasdan)
        $types = ['teacher', 'oshpaz', 'farrosh', 'hodim'];
        
        foreach ($types as $index => $type) {
            User::create([
                'name' => "Xodim " . ($index + 1),
                'phone' => '+99893000000' . $index,
                'type' => $type,
                'status' => 'active',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
