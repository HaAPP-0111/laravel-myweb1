<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = ['Đánh giá chi tiết', 'Top 5 sản phẩm đáng mua', 'Hướng dẫn sử dụng', 'Mẹo hay cho', 'So sánh', 'Tin tức rò rỉ'];
        $keywords = ['iPhone 15', 'MacBook M3', 'Galaxy S24', 'Tai nghe chống ồn', 'Laptop Gaming', 'Đồng hồ thông minh'];

        for ($i = 1; $i <= 50; $i++) {
            $title = fake()->randomElement($topics) . ' ' . fake()->randomElement($keywords) . ' - Phần ' . $i;
            
            DB::table('posts')->insert([
                'title'      => $title,
                'slug'       => Str::slug($title),
                'content'    => fake()->paragraphs(rand(3, 5), true),
                'image'      => 'post-' . rand(1, 10) . '.jpg',
                'status'     => rand(0, 1),
                
               
                'user_id'    => rand(1, 5), 
                
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
