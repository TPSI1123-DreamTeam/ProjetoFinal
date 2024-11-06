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
            "name"          => "Concerto",
            "category"      => "Concerto",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-20 23:07:33",
            "end_date"      => "2024-10-20 23:07:33",
            "type"          => "publico",
            "amount"        => "30.00",
            "image"         => "Corroios.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Casamento",
            "category"      => "Casamento",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-21 23:07:33",
            "end_date"      => "2024-10-21 23:07:33",
            "type"          => "privado",
            "amount"        => "70.00",
            "image"         => "eventoPublicoNosAlive.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Workshop Comporativo",
            "category"      => "Workshop",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-24 23:07:33",
            "end_date"      => "2024-10-24 23:07:33",
            "type"          => "privado",
            "amount"        => "60.00",
            "image"         => "Corroios.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Workshop - Finanças",
            "category"      => "Workshop",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-24 23:07:33",
            "end_date"      => "2024-10-24 23:07:33",
            "type"          => "publico",
            "amount"        => "35.00",
            "image"         => "eventoPublicoNosAlive.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Teatro",
            "category"      => "Teatro",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-26 23:07:33",
            "end_date"      => "2024-10-26 23:07:33",
            "type"          => "publico",
            "amount"        => "15.00",
            "image"         => "Corroios.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Concerto",
            "category"      => "Concerto",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-27 23:07:33",
            "end_date"      => "2024-10-27 23:07:33",
            "type"          => "publico",
            "amount"        => "30.00",
            "image"         => "eventoPublicoNosAlive.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Festival",
            "category"      => "Festival",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-30 23:07:33",
            "end_date"      => "2024-10-30 23:07:33",
            "type"          => "publico",
            "amount"        => "45.00",
            "image"         => "Corroios.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Festival",
            "category"      => "Festival",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-24 23:07:33",
            "end_date"      => "2024-10-24 23:07:33",
            "type"          => "publico",
            "amount"        => "100.00",
            "image"         => "eventoPublicoNosAlive.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Casamento",
            "category"      => "Casamento",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-10-24 23:07:33",
            "end_date"      => "2024-10-24 23:07:33",
            "type"          => "privado",
            "amount"        => "150.00",
            "image"         => "Corroios.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Teatro",
            "category"      => "Teatro",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-11-01 23:07:33",
            "end_date"      => "2024-11-01 23:07:33",
            "type"          => "publico",
            "amount"        => "55.00",
            "image"         => "eventoPublicoNosAlive.jpg",
        ]);

        DB::Table('events')->insert([
            "name"          => "Concerto",
            "category"      => "Concerto",
            "description"   => fake()->realText(rand(100, 200)),
            "localization"  => fake()->country(),
            "start_date"    => "2024-11-02 23:07:33",
            "end_date"      => "2024-11-02 23:07:33",
            "type"          => "publico",
            "amount"        => "25.00",
            "image"         => "Corroios.jpg",
        ]);
    }
}



// $table->string('category');   
// $table->string('description');   
// $table->string('localization'); 