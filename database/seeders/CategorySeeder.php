<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
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
        for ($i = 1; $i <= 10; $i++) {

            $name = fake()->unique()->words(3, true);
<<<<<<< HEAD

=======
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
            DB::table('categories')->insert([
                'catename' => ucfirst($name),
                'slug' => Str::slug($name),
                'status' => fake()->numberBetween(0, 1),
                'sort_order' => $i,
                'description' => fake()->sentence(30),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}