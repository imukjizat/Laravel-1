<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class GenreSeeder extends Seeder
{
    public function run()
    {
        DB::table('genres')->insert([
            ['id' => Uuid::uuid4()->toString(), 'name' => 'Action'],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'Comedy'],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'Drama'],
        ]);
    }
}
