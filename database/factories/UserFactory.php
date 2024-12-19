<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role_id' => null,
        ];
    }
}
