<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class ProfileFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'biodata' => $this->faker->text(200),
            'age' => $this->faker->numberBetween(18, 65),
            'address' => $this->faker->address(),
            'avatar' => $this->faker->imageUrl(),
            'user_id' => null,
        ];
    }
}
