<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LostItem>
 */
class LostItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3, false),
            'slug' => $this->faker->slug(3, false),
            'username' => $this->faker->name(),
            'userphone' => $this->faker->phoneNumber(),
            'class_id' => ClassModel::inRandomOrder()->first()?->id ?? 1, // Ambil dari factory Class
            'last_location' => $this->faker->sentence(2, false),
            'description' => $this->faker->paragraph(),
            'photo' => 'storage/lost-images/placeholder.png',
            'lost_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => 'hilang',
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1, // Ambil dari factory Category
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
