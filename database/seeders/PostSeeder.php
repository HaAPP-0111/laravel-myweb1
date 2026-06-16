<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
<<<<<<< HEAD
=======

>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        for ($i = 1; $i <= 50; $i++) {
            $title = fake()->unique()->sentence(rand(4, 8));
            
            DB::table('posts')->insert([
                'title'      => $title,
                'slug'       => Str::slug($title) . '-' . $i,
                'content'    => fake()->paragraphs(rand(3, 5), true),
                'image'      => 'post-' . rand(1, 10) . '.jpg',
                'status'     => rand(0, 1),
                
               
                'user_id'    => rand(1, 5), 
                
=======
        for ($i = 1; $i <= 20; $i++) {
            $title = fake()->unique()->sentence(rand(3, 6));

            DB::table('posts')->insert([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . $i,
                'image' => (rand(0, 1) === 1) ? ('post-' . rand(1, 10) . '.jpg') : null,
                'content' => fake()->paragraph(4),
                'status' => rand(0, 1),
                'userid' => rand(1, 5),
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
