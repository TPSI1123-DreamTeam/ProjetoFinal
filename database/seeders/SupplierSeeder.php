<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('suppliers')->insert([
            "name" => "supplier1",
            "email" => "supplier1@mail.com",
            "phone" => 999000001
        ]);

        DB::Table('suppliers')->insert([
            "name" => "supplier2",
            "email" => "supplier1@mail.com",
            "phone" => 999000002
        ]);

        DB::Table('suppliers')->insert([
            "name" => "supplier3",
            "email" => "supplier1@mail.com",
            "phone" => 999000003
        ]);
    }
}
