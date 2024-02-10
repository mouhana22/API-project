<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;


class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'address' => $this->faker->address,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'bedrooms' => $this->faker->randomDigit,
            'bathrooms' => $this->faker->randomDigit,
            'type' => $this->faker->randomElement(['apartment', 'villa']),
            'status' => $this->faker->randomElement(['available', 'sold']),
        ];
    }
}
