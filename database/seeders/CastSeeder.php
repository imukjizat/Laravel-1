<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CastSeeder extends Seeder
{
    public function run()
    {
        DB::table('casts')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Leonardo DiCaprio',
                'age' => 46,
                'biodata' => 'An award-winning actor.',
                'avatar' => 'leo.jpg',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Bradley Cooper',
                'age' => 47,
                'biodata' => 'Known for his roles in hit comedies.',
                'avatar' => 'bradley.jpg',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Will Smith',
                'age' => 55,
                'biodata' => 'Famous for his roles in action films and comedies.',
                'avatar' => 'will_smith.jpg',
            ],
        ]);
    }
}
