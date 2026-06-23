<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Điện thoại di động',
            'Laptop & Máy tính xách tay',
            'Máy tính bảng (Tablet)',
            'Đồng hồ thông minh',
            'Tai nghe Bluetooth',
            'Loa di động & Âm thanh',
            'Phụ kiện máy tính',
            'Thiết bị mạng',
            'Camera an ninh',
            'Pin sạc dự phòng',
            'Màn hình máy tính',
            'Bàn phím & Chuột'
        ];

        foreach ($categories as $index => $name) {
            DB::table('categories')->insert([
                'catename' => $name,
                'slug' => Str::slug($name),
                'status' => fake()->numberBetween(0, 1),
                'sort_order' => $index + 1,
                'description' => 'Chuyên cung cấp các sản phẩm ' . $name . ' chính hãng, chất lượng cao.',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}