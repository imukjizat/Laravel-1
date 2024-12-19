<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => Uuid::uuid4()->toString(), 'name' => 'Admin'],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'User'],
        ]);
    }
}
