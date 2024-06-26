<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence(3),
            'description'=> $this->faker->paragraph(3),
            'price'=> $this->faker->randomFloat(2, 1, 10),
            'image'=> $this->faker->imageUrl(),
        ];
    }
}
