<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'fullname'   => 'Admin DZ',
            'username'   => 'admin',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('123456'), // Mật khẩu là 123456
            'phone'      => '0987654321',
            'address'    => 'Hà Nội',
            'gender'     => 1,
            'birthday'   => '2000-01-01',
            'role'       => 1,
            'status'     => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'fullname'   => 'Nhân viên test',
            'username'   => 'staff',
            'email'      => 'test.666.908@gmail.com', // Dùng để test quên mật khẩu gửi mail
            'password'   => Hash::make('123456'), // Mật khẩu là 123456
            'phone'      => '0987654322',
            'address'    => 'Hà Nội',
            'gender'     => 2,
            'birthday'   => '2000-01-01',
            'role'       => 2, // Nhân viên (User)
            'status'     => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'fullname'   => fake()->name(),
                'username'   => fake()->unique()->userName(),
                'email'      => fake()->unique()->safeEmail(),
                'password'   => Hash::make('123456'), // Đã sửa lại chuẩn Hash Laravel
                'phone'      => fake()->unique()->phoneNumber(),
                'address'    => fake()->address(),
                'gender'     => fake()->randomElement([0, 1, 2]), // 1: Nam, 2: Nữ, 0: Khác
                'birthday'   => fake()->date('Y-m-d', '2005-01-01'), // Ngày sinh ngẫu nhiên trước năm 2005
                'role'       => fake()->randomElement([1, 2]), // 1: quản lý, 2: nhân viên
                'status'     => fake()->numberBetween(0, 1), // 1: kích hoạt, 0: khóa
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}