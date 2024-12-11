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
                'name'        => 'Concerto',
                'description' => 'Concertos inesquecíveis, emoções ao vivo! 
Transformamos a sua ideia num espetáculo único e vibrante. Especializados na organização de concertos, cuidamos de cada detalhe para garantir uma experiência memorável tanto para o público como para os artistas.
Desde a escolha do local, som e iluminação de alta qualidade, cenografia, logística, segurança, até à gestão de bilheteira e promoção, oferecemos uma solução completa e personalizada. Trabalhamos em estreita colaboração com artistas, produtores e equipas técnicas para criar um evento dinâmico e cativante, onde a música seja o verdadeiro protagonista.
Combinando criatividade, profissionalismo e paixão pela música, garantimos que o seu concerto seja um sucesso e deixe uma marca inesquecível em cada espetador.
Deixe-nos criar o palco perfeito para a magia acontecer.',
                'image'       => '/private/Concerto-private 1.png',
                'quantity'    => 200,
                'id'          => 1
            ],
            1 => [
                'name'        => 'Casamento',
                'description' => 'Organizamos o teu casamento dos sonhos, cuidando de todos os detalhes para que o teu grande dia seja perfeito e livre de stress! 
Desde a escolha do local, decoração, catering, fotografia, até à gestão do cronograma do evento, a nossa equipa especializada oferece um serviço personalizado e dedicado, adaptado aos seus desejos e estilo.
Deixe-nos transformar a sua visão em realidade e tornar o seu casamento num evento memorável, repleto de emoções e momentos únicos.',
                'image'       => '/private/Casamento.png',
                'quantity'    => 150,
                'id'          => 2
            ],
            2 => [
                'name'        => 'Workshop',
                'description' => 'Workshops dinâmicos e inspiradores para experiências transformadoras! 
Especializamo-nos na criação de workshops envolventes, pensados para proporcionar aprendizagens práticas e momentos de conexão. Seja qual for o tema ou área de interesse, cuidamos de todos os detalhes para garantir um ambiente profissional e motivador.
Combinando organização impecável, atenção aos detalhes e um toque criativo, garantimos workshops que inspiram, educam e geram impacto duradouro.
Transforme ideias em ação. Juntos, criamos experiências que fazem a diferença.',
                'image'       => '/private/Workshop1.jpg',
                'quantity'    => 35,
                'id'          => 3
            ],
            3 => [
                'name' => 'Teatro',
                'description' => 'Teatro que emociona e encanta! 
Planeamos e organizamos espetáculos teatrais únicos, cuidando de cada detalhe – desde a escolha do espaço, iluminação, som, cenografia, até à promoção e logística. Criamos uma experiência imersiva que dá vida às histórias e cativa o público do início ao fim.
Transforme a sua produção num espetáculo memorável!',
                'image'       => '/private/teatro1.jpg',
                'quantity'    => 50,
                'id'          => 4
            ],
            4 => [
                'name' => 'Festival',
                'description' => 'Festivais que celebram momentos inesquecíveis! 
Organizamos festivais vibrantes e envolventes, cuidando de tudo, desde o planeamento logístico, palcos, som, iluminação, segurança, até à experiência do público. 
Criamos eventos que combinam criatividade, energia e organização impecável, garantindo que cada instante seja memorável para todos os participantes.
Transforme a sua visão num festival de emoções únicas!',
                'image'       => '',
                'quantity'    => 300,
                'id'          => 5
            ],
            5 => [
                'name' => 'Evento Corporativo',
                'description' => 'Eventos corporativos que refletem a essência da sua empresa! 
Transformamos a sua visão em realidade, criando eventos corporativos profissionais e impactantes que promovem a sua marca e fortalecem as suas conexões. Desde conferências, lançamentos de produtos, workshops, jantares de gala até team building, cuidamos de todos os detalhes para garantir uma experiência sem falhas.
Combinando criatividade, organização impecável e atenção ao detalhe, garantimos que o seu evento corporativo se destaque e deixe uma impressão duradoura nos participantes.
Eleve a sua marca e celebre o sucesso com eventos memoráveis.',
                'image'       => '/private/Eventos Corporativos.jpg',
                'quantity'    => 30,
                'id'          => 6
            ],
            6 => [
                'name' => 'Evento Privado',
                'description' => 'Eventos corporativos que refletem a essência da sua empresa!A sua festa, do jeito que sempre sonhou! 
Transformamos a sua celebração num evento único e inesquecível. Seja um aniversário, um jantar especial, uma reunião de amigos ou uma festa temática, cuidamos de todos os detalhes para criar uma experiência memorável.
Desde a escolha do local, decoração personalizada, catering de alta qualidade, música, entretenimento e muito mais, trabalhamos consigo para dar vida à sua visão. Garantimos que cada momento seja pensado para refletir a sua personalidade e criar um ambiente acolhedor e divertido para os seus convidados.
Festeje com estilo, crie memórias para a vida.',
                'image'       => '/private/Festas-Privadas.jpg',
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

        $festivalCounter = 0;
        $exceptionNotCreatePayment = array(2,6,7);

        for ($j = 0; $j < 7; $j++) {

            for ($i = 0; $i < 30; $i++) {

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

                if($festivalCounter==10){
                    $festivalCounter = 0;
                }

                if( $arrayCategory[$categoryRandom]['id'] !== 5 ){
                    $seederImage = $arrayCategory[$categoryRandom]['image'];
                }else{
                    $seederImage = 'public/festival'.$festivalCounter.'.jpg';
                    $festivalCounter++;
                }

                $event = Event::create([
                    'name'                   => $arrayCategory[$categoryRandom]['name'],
                    'category_id'            => $arrayCategory[$categoryRandom]['id'],
                    'image'                  => $seederImage,
                    'description'            => $arrayCategory[$categoryRandom]['description'], //fake()->realText(rand(500,700)),
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