<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $brandName = fake()->unique()->company(); // Tạo tên công ty/thương hiệu ngẫu nhiên
            
            DB::table('brands')->insert([
                'brandname'   => $brandName,
                'slug'        => Str::slug($brandName),
                'image'       => null, // Hoặc fake()->imageUrl(200, 200, 'logo') nếu muốn có link ảnh mẫu
                'status'      => fake()->numberBetween(0, 1),
                'sort_order'  => $i,
                'description' => fake()->sentence(20),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}