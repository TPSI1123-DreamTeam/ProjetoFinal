<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('events')->insert([
            "name"       => "Concerto",
            "start_date" => "2024-10-20 23:07:33",
            "end_date"   => "2024-10-20 23:07:33",
            "type"       => "publico",
            "amount"     => "30.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Casamento",
            "start_date" => "2024-10-21 23:07:33",
            "end_date"   => "2024-10-21 23:07:33",
            "type"       => "privado",
            "amount"     => "70.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Workshop Comporativo",
            "start_date" => "2024-10-24 23:07:33",
            "end_date"   => "2024-10-24 23:07:33",
            "type"       => "privado",
            "amount"     => "60.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Workshop - Finanças",
            "start_date" => "2024-10-24 23:07:33",
            "end_date"   => "2024-10-24 23:07:33",
            "type"       => "publico",
            "amount"     => "35.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Concerto",
            "start_date" => "2024-10-26 23:07:33",
            "end_date"   => "2024-10-26 23:07:33",
            "type"       => "publico",
            "amount"     => "15.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Concerto",
            "start_date" => "2024-10-27 23:07:33",
            "end_date"   => "2024-10-27 23:07:33",
            "type"       => "publico",
            "amount"     => "30.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Concerto",
            "start_date" => "2024-10-30 23:07:33",
            "end_date"   => "2024-10-30 23:07:33",
            "type"       => "publico",
            "amount"     => "45.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Casamento",
            "start_date" => "2024-10-24 23:07:33",
            "end_date"   => "2024-10-24 23:07:33",
            "type"       => "privado",
            "amount"     => "100.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Casamento",
            "start_date" => "2024-10-24 23:07:33",
            "end_date"   => "2024-10-24 23:07:33",
            "type"       => "privado",
            "amount"     => "150.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Concerto",
            "start_date" => "2024-11-01 23:07:33",
            "end_date"   => "2024-11-01 23:07:33",
            "type"       => "publico",
            "amount"     => "55.00",
        ]);

        DB::Table('events')->insert([
            "name"       => "Concerto",
            "start_date" => "2024-11-02 23:07:33",
            "end_date"   => "2024-11-02 23:07:33",
            "type"       => "publico",
            "amount"     => "25.00",
        ]);
    }
}