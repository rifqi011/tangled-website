<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoundItem>
 */
class FoundItemFactory extends Factory
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
            'description' => $this->faker->paragraph(),
            'photo' => 'storage/found-images/placeholder.png',
            'found_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'found_location' => $this->faker->sentence(2, false),
            'status' => 'disimpan',
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
