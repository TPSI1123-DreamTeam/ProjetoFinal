<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Payment;

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
                'quantity'    => 200,
                'id'          => 1
            ],
            1 => [
                'description' => 'Casamento',
                'image'       => 'Casamento.png',
                'quantity'    => 150,
                'id'          => 2
            ],
            2 => [
                'description' => 'Workshop',
                'image'       => 'Workshop1.jpg',
                'quantity'    => 35,
                'id'          => 3
            ],
            3 => [
                'description' => 'Teatro',
                'image'       => 'teatro1.jpg',
                'quantity'    => 50,
                'id'          => 4
            ],
            4 => [
                'description' => 'Festival',
                'image'       => 'RockMusic.jpg',
                'quantity'    => 300,
                'id'          => 5
            ],
            5 => [
                'description' => 'Evento Corporativo',
                'image'       => 'Workshop-Corporativo.webp',
                'quantity'    => 30,
                'id'          => 6
            ],
            6 => [
                'description' => 'Evento Privado',
                'image'       => 'Festas-Privadas.jpg',
                'quantity'    => 20,
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
            2 => "aprovado", 
            3 => "ativo", 
            4 => "aprovado", 
            5 => "pendente" 
        ];


        $arrayEventStatus1 = [
            0 => "concluido", 
            1 => "cancelado", 
            2 => "concluido", 
            3 => "recusado", 
            4 => "concluido", 
            5 => "concluido" 
        ];

        
        $startDateaArray = [
            0 => '2024-07-01',
            1 => '2024-08-01',
            2 => '2024-09-01',
            3 => '2024-10-01',
            4 => '2024-11-01',
            5 => '2024-12-15',
            6 => '2025-01-01',
        ];


        $endDateaArray = [
            0 => '2024-07-31',
            1 => '2024-08-31',
            2 => '2024-09-30',
            3 => '2024-10-31',
            4 => '2024-12-14',
            5 => '2024-12-31',
            6 => '2025-01-31',
        ];

        $exceptionNotCreatePayment = array(2,6,7);

        for ($j = 0; $j < 7; $j++) {

            for ($i = 0; $i < 10; $i++) {

                $categoryRandom = rand(0,6);
                $managerRandom  = rand(0,1);
                $typeRandom     = 0; 
                if( in_array($arrayCategory[$categoryRandom]['id'], $exceptionNotCreatePayment) ){
                    $typeRandom = 1;  
                }

                $date           = fake()->dateTimeBetween($startDateaArray[$j], $endDateaArray[$j]);
                $randomAmount   = rand(1000,20000);
                $randomUsers    = intval($arrayCategory[$categoryRandom]['quantity']);
                $ticketAmount   = ($randomAmount / $randomUsers) * 5;
                $startTime      = rand(10,23).":00:00";                  

                if($j<5){
                    $eventStatus = $arrayEventStatus1[rand(0,5)];  
                }else{
                    $eventStatus = $arrayEventStatus[rand(0,5)]; 
                }

                if($eventStatus === 'pendente'){
                    $managerId   = 0;
                }else{
                    $managerId   = $arrayManager[$managerRandom];
                }             

                $fakerCity = fake()->city();
                $owner_id  = rand(4,5);

                $event = Event::create([
                    'name'                   => $arrayCategory[$categoryRandom]['description'].' - '.$fakerCity,
                    'category_id'            => $arrayCategory[$categoryRandom]['id'],
                    'image'                  => $arrayCategory[$categoryRandom]['image'],
                    'description'            => fake()->realText(rand(500,700)),
                    'localization'           => $fakerCity,
                    'start_date'             => $date,
                    'start_time'             => $startTime,
                    'end_date'               => $date,
                    'type'                   => $arrayType[$typeRandom],
                    'amount'                 => $randomAmount,
                    'ticket_amount'          => $ticketAmount,
                    'owner_id'               => $owner_id,
                    'manager_id'             => $managerId,               
                    'number_of_participants' => $randomUsers,
                    'event_status'           => $eventStatus
                ]);        
    
                $users = User::inRandomOrder()->take($randomUsers)->pluck('id');
                $event->users()->attach($users);

                
                if($eventStatus === 'concluido' || $eventStatus === 'aprovado' || $eventStatus === 'ativo'){             

                    if( !in_array($arrayCategory[$categoryRandom]['id'], $exceptionNotCreatePayment) ){

                        // Registra um pagamento para cada usuário associado
                        $paymentsData = [];
                        foreach ($users as $userId) {
                            $paymentsData[] = [
                                'stripe_id'  => Hash::make($userId),
                                'user_id'    => $userId,
                                'event_id'   => $event->id,
                                'name'       => $event->name,
                                'amount'     => $ticketAmount, // Supondo que o preço do evento esteja no modelo $event
                                'status'     => true, // Define o status inicial, pode ser 'completed', etc.
                                'type'       => 'ticket',
                                'date'       => $date,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];

                            //CONFIRMATION OF ATTENDING THE EVENT
                            DB::table('event_user')
                            ->where('event_id', $event->id)
                            ->where('user_id', $userId)
                            ->update([
                                'confirmation' => true                            
                            ]);
                        }

                        // Insere os registros de pagamento na tabela 'payments' de forma eficiente
                        DB::table('payments')->insert($paymentsData);
                    }


                    if( $eventStatus === 'concluido' || $eventStatus === 'aprovado' ) {

                        // CREATE CURRENT ACCOUNT EVENT PAYMENT
                        $payment = Payment::create([  
                            'stripe_id'  => Hash::make(rand(1,500)),
                            'user_id'    => $owner_id,
                            'event_id'   => $event->id,
                            'name'       => $event->name,
                            'amount'     => $randomAmount, // Supondo que o preço do evento esteja no modelo $event
                            'status'     => true, // Define o status inicial, pode ser 'completed', etc.
                            'date'       => $date,
                            'type'       => 'event_payment',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);   
    
                        //$paymentId = DB::table('payments')->insert($payment);
    
                        // CREATE CURRENT ACCOUNT PAYMENT
                        $currentAccount = [  
                            'description'            => 'Pagamento Cartão de Crédito - via Stripe',              
                            'amount'                 => $randomAmount,
                            'amount_paid'            => $randomAmount,
                            'payment_id'             => $payment->id,
                            'form_of_payment'        => 'credit_card',
                            'event_id'               => $event->id,
                            'status'                 => 1,               
                            'currency'               => 'eur',
                            'created_at'             => now(),
                            'updated_at'             => now()
                        ]; 
                        
                        $currentAccountId = DB::table('current_accounts')->insert($currentAccount);
                    } else{

                        $currentAccount = [  
                            'description'            => 'Pagamento Cartão de Crédito - via Stripe',              
                            'amount'                 => $randomAmount,
                            'amount_paid'            => 0,
                            'payment_id'             => 0,
                            'form_of_payment'        => 'credit_card',
                            'event_id'               => $event->id,
                            'status'                 => 1,               
                            'currency'               => 'eur',
                            'created_at'             => now(),
                            'updated_at'             => now()
                        ]; 
                        
                        $currentAccountId = DB::table('current_accounts')->insert($currentAccount);
                    }                                   
                }
            }   
        }
    }
}