<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Prasetya Riski Wa'afan",
            'email' => 'pr0165341@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
