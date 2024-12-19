<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $user1Id = DB::table('users')->where('name', 'John Doe')->value('id');
        $user2Id = DB::table('users')->where('name', 'Jane Smith')->value('id');

        $movieInceptionId = DB::table('movies')->where('title', 'Inception')->value('id');
        $movieHangoverId = DB::table('movies')->where('title', 'The Hangover')->value('id');
        $moviePursuitofHappynessId = DB::table('movies')->where('title', 'Pursuit of Happyness')->value('id');

        DB::table('reviews')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'review' => 'Amazing movie with great visuals and storytelling!',
                'rating' => 5,
                'user_id' => $user1Id,
                'movie_id' => $movieInceptionId,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'review' => 'Hilarious and entertaining. A great comedy movie!',
                'rating' => 4,
                'user_id' => $user2Id,
                'movie_id' => $movieHangoverId,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'review' => 'Thought-provoking and intense. A must-watch!',
                'rating' => 5,
                'user_id' => $user2Id,
                'movie_id' => $movieInceptionId,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'review' => 'An inspiring story of perseverance and hope!',
                'rating' => 5,
                'user_id' => $user1Id,
                'movie_id' => $moviePursuitofHappynessId,
            ],
        ]);
    }
}
