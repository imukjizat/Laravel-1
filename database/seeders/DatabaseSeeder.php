<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Memanggil beberapa seeder sekaligus
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            GenreSeeder::class,
            MovieSeeder::class,
            CastSeeder::class,
            CastMovieSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
