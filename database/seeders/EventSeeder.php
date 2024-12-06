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

        $arrayEventStatus = [
            0 => "pendente", 
            1 => "ativo", 
            2 => "cancelado", 
            3 => "recusado", 
            4 => "aprovado", 
            5 => "concluido" 
        ];

        
        $startDateaArray = [
            0 => '2024-07-01',
            1 => '2024-08-01',
            2 => '2024-09-01',
            3 => '2024-10-01',
            4 => '2024-11-01',
            5 => '2024-12-01',
            6 => '2025-01-01',
        ];


        $endDateaArray = [
            0 => '2024-07-31',
            1 => '2024-08-31',
            2 => '2024-09-30',
            3 => '2024-10-31',
            4 => '2024-11-30',
            5 => '2024-12-31',
            6 => '2025-01-31',
        ];


        // $endDate = 'now'; // Current date and time
        // $date = $faker->dateTimeBetween($startDate, $endDate);

        for ($j = 0; $j < 7; $j++) {

            for ($i = 0; $i < 20; $i++) {

                $categoryRandom = rand(0,6);
                $managerRandom  = rand(0,1);
                $typeRandom     = rand(0,1);
                //$date           = fake()->dateTimeBetween('-1 week', '+1 week');
                $date           = fake()->dateTimeBetween($startDateaArray[$j], $endDateaArray[$j]);
                $randomAmount   = rand(1000,20000);
                $randomUsers    = rand(20, 50);
                $ticketAmount   = ($randomAmount / $randomUsers) / 3;
                $startTime      = rand(10,23).":00:00";

                $event = Event::create([
                    'name'                   => $arrayCategory[$categoryRandom]['description'],
                    'category_id'            => $arrayCategory[$categoryRandom]['id'],
                    'image'                  => $arrayCategory[$categoryRandom]['image'],
                    'description'            => fake()->realText(rand(500,700)),
                    'localization'           => fake()->city(),
                    'start_date'             => $date,
                    'start_time'             => $startTime,
                    'end_date'               => $date,
                    'type'                   => $arrayType[$typeRandom],
                    'amount'                 => $randomAmount,
                    'ticket_amount'          => $ticketAmount,
                    'owner_id'               => rand(4,5),
                    'manager_id'             => $arrayManager[$managerRandom],               
                    'number_of_participants' => $randomUsers,
                    'event_status'           => $arrayEventStatus[rand(0,5)]
                ]);
        
    
                $users = User::inRandomOrder()->take($randomUsers)->pluck('id');
                $event->users()->attach($users);
            }   

        }
    }
}

