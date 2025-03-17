<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassModel::create([
            'name' => 'X PPLG 1',
            'status' => 'active'
        ]);

        ClassModel::create([
            'name' => 'X PPLG 2',
            'status' => 'active'
        ]);

        ClassModel::create([
            'name' => 'XI PPLG 1',
            'status' => 'active'
        ]);

        ClassModel::create([
            'name' => 'XI PPLG 2',
            'status' => 'active'
        ]);

        ClassModel::create([
            'name' => 'XII PPLG 1',
            'status' => 'active'
        ]);

        ClassModel::create([
            'name' => 'XII PPLG 2',
            'status' => 'active'
        ]);
    }
}
