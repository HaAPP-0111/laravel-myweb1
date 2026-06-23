<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // <--- Thêm dòng này để dùng được Str::slug
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productBases = [
            'iPhone 15 Pro Max', 'Samsung Galaxy S24 Ultra', 'MacBook Pro M3', 'Asus ROG Strix', 
            'Tai nghe AirPods Pro', 'Apple Watch Series 9', 'Loa Marshall Emberton', 
            'Logitech MX Master 3S', 'Keychron K2', 'Màn hình Dell UltraSharp',
            'iPad Pro 11', 'Dell XPS 15', 'Sony WH-1000XM5', 'Xiaomi 14',
            'Sạc dự phòng Anker'
        ];

        for ($i = 1; $i <= 50; $i++) {
            
            $productName = fake()->randomElement($productBases) . ' - Mẫu ' . $i;
            $price = rand(500000, 40000000);
            
            DB::table('products')->insert([
                'productname'   => $productName,
                'slug'          => Str::slug($productName) . '-' . $i,
                'price'         => $price,
                // Ép kiểu về INT vì hàm rand() cần tham số là số nguyên nguyên bản
                'pricediscount' => rand((int)($price * 0.7), (int)($price * 0.9)),
                'image'         => 'product-' . rand(1, 10) . '.jpg',
                'description'   => fake()->paragraph(),
                'status'        => rand(0, 1),
                'brandid'       => rand(1, 10),
                'cateid'        => rand(1, 10),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}