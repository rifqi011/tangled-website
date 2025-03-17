<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LostItem;
use App\Models\FoundItem;
use Illuminate\Database\Seeder;
use Database\Seeders\ClassSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create data for admins/users
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@example.com',
            'role' => 'superadmin'
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);

        $this->call([
            CategorySeeder::class,
            ClassSeeder::class,
        ]);

        FoundItem::factory(20)->create();
        LostItem::factory(20)->create();
    }
}
