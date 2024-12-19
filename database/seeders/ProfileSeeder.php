<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $user1 = DB::table('users')->where('name', 'John Doe')->value('id');
        $user2 = DB::table('users')->where('name', 'Jane Smith')->value('id');

        DB::table('profiles')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'biodata' => 'Lorem ipsum dolor sit amet.',
                'age' => 30,
                'address' => '123 Main Street',
                'avatar' => 'avatar1.jpg',
                'user_id' => $user1,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'biodata' => 'Consectetur adipiscing elit.',
                'age' => 25,
                'address' => '456 Elm Street',
                'avatar' => 'avatar2.jpg',
                'user_id' => $user2,
            ],
        ]);
    }
}
