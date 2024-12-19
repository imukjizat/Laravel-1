<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class CastMovieFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'movie_id' => null,
            'cast_id' => null,
        ];
    }
}
