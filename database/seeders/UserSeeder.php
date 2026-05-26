<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                // Hash::make() dùng để mã hóa mật khẩu bảo mật, ở đây mặc định là 'password'
                'password' => Hash::make('password'), 
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}