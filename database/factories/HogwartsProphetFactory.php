<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HogwartsProphet>
 */
class HogwartsProphetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'writer' => $this->faker->name(),
            'content' => $this->faker->paragraph(5),
            'image' => 'hogwarts-prophet/img-hp-' . rand(1, 5) . '.jpg', // Sesuaikan dengan nama file gambar kamu
        ];
    }
}
