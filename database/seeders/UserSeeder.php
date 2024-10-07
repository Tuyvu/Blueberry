<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Tuy',
            'lastname' => 'Vu',
            'email' => 'vutuy38122@gmail.com',
            'phone' => '0123456789',
            'password' => Hash::make('Vutuy123!'),  // Mã hóa mật khẩu
            'role_id' => 1,  // Gán role_id là 1
            'city' => 'Hanoi',
            'address' => '123 Main Street',
        ]);
    }
}
