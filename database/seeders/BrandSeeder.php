<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Apple', 'Samsung', 'Sony', 'Asus', 'Dell', 
            'HP', 'Lenovo', 'Xiaomi', 'Oppo', 'LG'
        ];

        foreach ($brands as $index => $name) {
            DB::table('brands')->insert([
                'brandname' => $name,
                'slug' => Str::slug($name),
                'image' => 'brand' . ($index + 1) . '.png',
                'status' => fake()->numberBetween(0, 1),
                'sort_order' => $index + 1,
                'description' => 'Thương hiệu ' . $name . ' chính hãng uy tín thế giới.',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}