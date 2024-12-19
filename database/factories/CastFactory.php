<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class CastFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(20, 70),
            'biodata' => $this->faker->text(200),
            'avatar' => $this->faker->imageUrl(),
        ];
    }
}
