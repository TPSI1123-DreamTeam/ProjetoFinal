<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('roles')->insert([
            "name" => "admin",
        ]);

        DB::Table('roles')->insert([
            "name" => "manager",
        ]);

        DB::Table('roles')->insert([
            "name" => "user",
        ]);
    }
}
