<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayCategory = [
            0 => [
                'description' => 'Concerto',
                'image'       => 'Corroios.jpg',
                'id'          => 1
            ],
            1 => [
                'description' => 'Casamento',
                'image'       => 'Casamento.png',
                'id'          => 2
            ],
            2 => [
                'description' => 'Workshop',
                'image'       => 'Workshop1.jpg',
                'id'          => 3
            ],
            3 => [
                'description' => 'Teatro',
                'image'       => 'teatro1.jpg',
                'id'          => 4
            ],
            4 => [
                'description' => 'Festival',
                'image'       => 'RockMusic.jpg',
                'id'          => 5
            ],
            5 => [
                'description' => 'Evento Corporativo',
                'image'       => 'Workshop-Corporativo.webp',
                'id'          => 6
            ],
            6 => [
                'description' => 'Evento Privado',
                'image'       => 'Festas-Privadas.jpg',
                'id'          => 7
            ],
        ];

        $arrayManager = [
            0 => 1, //gil
            1 => 3 //pedro
        ];

        $arrayType = [
            0 => "publico", //gil
            1 => "privado" //pedro
        ];

        for ($i = 0; $i < 30; $i++) {

            $categoryRandom = rand(0,6);
            $managerRandom  = rand(0,1);
            $typeRandom     = rand(0,1);

            $date = fake()->dateTimeBetween('-1 week', '+1 week');

            $event = Event::create([
                'name'          => $arrayCategory[$categoryRandom]['description'],
                'category_id'   => $arrayCategory[$categoryRandom]['id'],
                'image'         => $arrayCategory[$categoryRandom]['image'],
                'description'   => fake()->realText(rand(500,700)),
                'localization'  => fake()->city(),
                'start_date'    => $date,
                'end_date'      => $date,
                'type'          => $arrayType[$typeRandom],
                'amount'        => rand(1000,20000),
                'owner_id'      => rand(1,100),
                'manager_id'    => $arrayManager[$managerRandom]               
            ]);
       
   
            $users = User::inRandomOrder()->take(rand(20, 50))->pluck('id');
            $event->users()->attach($users);
        }   
    }
}