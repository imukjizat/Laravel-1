<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class MovieFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'title' => $this->faker->sentence(3),
            'synopsis' => $this->faker->paragraph(),
            'poster' => $this->faker->imageUrl(),
            'year' => $this->faker->year(),
            'available' => $this->faker->boolean(),
            'genre_id' => null,
        ];
    }
}
