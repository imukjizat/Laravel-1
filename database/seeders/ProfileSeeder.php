<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'biodata' => 'Lorem ipsum dolor sit amet.',
                'age' => 30,
                'address' => '123 Main Street',
                'avatar' => 'avatar1.jpg',
                'user_id' => 'UUID_USER_1', // Ganti dengan UUID dari User pertama
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'biodata' => 'Consectetur adipiscing elit.',
                'age' => 25,
                'address' => '456 Elm Street',
                'avatar' => 'avatar2.jpg',
                'user_id' => 'UUID_USER_2', // Ganti dengan UUID dari User kedua
            ],
        ]);
    }
}
