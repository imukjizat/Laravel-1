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

        $adminId = DB::table('roles')->where('name', 'Admin')->value('id');
        $userId = DB::table('roles')->where('name', 'User')->value('id');

        DB::table('users')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role_id' => $adminId,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userId,
            ],
        ]);
    }
}
