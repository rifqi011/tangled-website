<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Sepatu',
            'status' => 'active'
        ]);

        Category::create([
            'name' => 'Handphone',
            'status' => 'active'
        ]);

        Category::create([
            'name' => 'Tas',
            'status' => 'active'
        ]);

        Category::create([
            'name' => 'Baju',
            'status' => 'active'
        ]);

        Category::create([
            'name' => 'Kunci',
            'status' => 'active'
        ]);

        Category::create([
            'name' => 'Alat Tulis',
            'status' => 'active'
        ]);

        Category::create([
            'name' => 'Lainnya',
            'status' => 'active'
        ]);
    }
}
