<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // 紐づけ
            'title' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['Park', 'Cafe', 'Beach']),
            'location_name' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'description' => $this->faker->paragraph(),
            'visit_time' => $this->faker->randomElement(['morning', 'afternoon', 'evening', 'night']),
            'status' => 'public',
        ];
    }
}
