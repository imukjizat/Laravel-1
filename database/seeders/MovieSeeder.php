<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $genreActionId = DB::table('genres')->where('name', 'Action')->value('id');
        $genreComedyId = DB::table('genres')->where('name', 'Comedy')->value('id');
        $genreDramaId = DB::table('genres')->where('name', 'Drama')->value('id');

        DB::table('movies')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'title' => 'Inception',
                'synopsis' => 'A mind-bending thriller.',
                'poster' => 'images/inception.jpg',
                'year' => '2010',
                'available' => true,
                'genre_id' => $genreActionId,
                'created_at' => now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'title' => 'The Hangover',
                'synopsis' => 'A comedy about a wild bachelor party.',
                'poster' => 'images/hangover.jpg',
                'year' => '2009',
                'available' => true,
                'genre_id' => $genreComedyId,
                'created_at' => now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'title' => 'The Pursuit of Happyness',
                'synopsis' => 'A drama about a struggling salesman.',
                'poster' => 'images/pursuit_of_happyness.jpg',
                'year' => '2006',
                'available' => true,
                'genre_id' => $genreDramaId,
                'created_at' => now(),
            ],
        ]);
    }
}
