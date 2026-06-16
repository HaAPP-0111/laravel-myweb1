<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            UserSeeder::class,

            //cac seeder co khoa ngoai
=======
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // các seeder không có khóa ngoại
            CategorySeeder::class,
            BrandSeeder::class,
            UserSeeder::class,
            
            // các seeder có khóa ngoại
>>>>>>> fca0cb4305e90ded0a3aae37799d569b63faf474
            ProductSeeder::class,
            PostSeeder::class,
        ]);
    }
}