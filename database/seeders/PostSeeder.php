<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $title = fake()->unique()->sentence(rand(4, 8)); // Tạo tiêu đề ngẫu nhiên
            
            DB::table('posts')->insert([
                'title'      => $title,
                'slug'       => Str::slug($title) . '-' . $i,
                'content'    => fake()->paragraphs(rand(3, 5), true), // Nội dung gồm nhiều đoạn văn
                'image'      => 'post-' . rand(1, 10) . '.jpg',
                'status'     => rand(0, 1),
                'user_id'    => rand(1, 3), // Giả định bạn đã có sẵn vài ba user ở UserSeeder (ví dụ từ id 1 đến 3)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
