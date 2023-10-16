<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_id = Category::query()->inRandomOrder()->value('id');

        return [
            'name'  => $this->faker->word,
            'category_id' => $category_id,
            'price' => $this->faker->randomNumber(2),
        ];
    }
}
