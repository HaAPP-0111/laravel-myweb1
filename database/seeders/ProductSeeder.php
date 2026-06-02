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
        for ($i = 1; $i <= 50; $i++) {
            
            $productName = fake()->unique()->words(rand(2, 5), true);
            $price = rand(100000, 50000000);
            
            DB::table('products')->insert([
                'productname'   => ucfirst($productName),
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