<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role_id' => 'UUID_ROLE_1', // Ganti dengan UUID dari role Admin
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'role_id' => 'UUID_ROLE_2', // Ganti dengan UUID dari role User
            ],
        ]);
    }
}
