<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CastMovieSeeder extends Seeder
{
    public function run()
    {
        $movieInceptionId = DB::table('movies')->where('title', 'Inception')->value('id');
        $movieHangoverId = DB::table('movies')->where('title', 'The Hangover')->value('id');
        $moviePursuitofHappynessId = DB::table('movies')->where('title', 'The Pursuit of Happyness')->value('id');

        $castLeoId = DB::table('casts')->where('name', 'Leonardo DiCaprio')->value('id');
        $castBradleyId = DB::table('casts')->where('name', 'Bradley Cooper')->value('id');
        $castSmithId = DB::table('casts')->where('name', 'Will Smith')->value('id');


        DB::table('cast_movies')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'movie_id' => $movieInceptionId,
                'cast_id' => $castLeoId,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'movie_id' => $movieHangoverId,
                'cast_id' => $castBradleyId,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'movie_id' => $moviePursuitofHappynessId,
                'cast_id' => $castSmithId,
            ],
        ]);
    }
}
