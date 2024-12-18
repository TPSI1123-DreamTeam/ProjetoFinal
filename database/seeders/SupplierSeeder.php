<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Event;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagesArray = [
            0 => "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            1 => "https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            2 => "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            3 => "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            4 => "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            5 => "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        ];

        $suppliersList = [
            0 => 'Espaços Mágicos Lda',
            1 => 'Ambientes & Eventos Unipessoal',
            2 => 'Cenários Perfeitos Lda',
            3 => 'Sua Festa, Nosso Espaço Unipessoal',
            4 => 'Espaço Celebre Novo Lda',
            5 => 'Serviços adicionais',
            6 => 'Produção e logística Unipessoal',
            7 => 'Detalhes que Fazem a Diferença Lda',
            8 => 'Ambientes & Eventos',
            9 => 'Cenários Perfeitos Unipessoal',
            10 => 'Soluções Personalizadas SA',
            11 => 'Tudo para sua Festa Lda',
            12 => 'Sabores & Afeto Lda',
            13 => 'Paladar Gourmet Unipessoal',
            14 => 'Mesa & Arte',
            15 => 'Gastronomia com Arte Lda',
            16 => 'Delícias para Celebrar',
            17 => 'Nosso Espaço Unipessoal',
            18 => 'Soluções Completas',
            19 => 'Serviços adicionais Lda',
            20 => 'Produção e logística',
            21 => 'Espaços Mágicos Novo Lda',
            22 => 'Ambientes & Eventos Unipessoal',
            23 => 'Cenários Perfeitos 2024',
            24 => 'Produção impecável',
            25 => 'Técnica & Eficiência',
            26 => 'Encanto Decor Unipessoal',
            27 => 'Toque Mágico',
            28 => 'Cores & Formas',
            29 => 'Arte & Design',
            30 => 'Alegria & Diversão',
            31 => 'Showtime',
            32 => 'Momentos Inesquecíveis',
            33 => 'Animação Total',
            34 => 'Entretenimento de Primeira'
        ];

        $suppliersDescription = [
            0 => 'salões de festas, hotéis, centros de convenções, etc.',
            1 => 'empresas de buffet, chefs, bartenders, etc.',
            2 => 'floristas, cenógrafos, empresas de locação de móveis e acessórios, etc.',
            3 => 'bandas, DJs, artistas, mágicos, etc.',
            4 => 'empresa de som e iluminação, empresa de vídeo e filmagem, fotógrafos, etc.',
            5 => 'segurança, transporte, recepcionistas, etc.',
            6 => 'empresa de montagem e desmontagem, empresa de aluguel de equipamentos, etc.'
        ];


        for ($i = 0; $i < 35; $i++) {

            //$random = rand(0,34);
            $random = rand(0,6);

            $supplier = Supplier::create([
                'name'    => $suppliersList[$i], //fake()->name(),
                'contact' => (string) fake()->numberBetween(912345678, 936456789),
                'email'   => fake()->safeEmail(),
                'image'   => $imagesArray[rand(0,5)],
                'supplier_type_id' => rand(1,6)
            ]);

            $events = Event::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $supplier->events()->attach($events);
            

            foreach ($events as $eventId) {
                $supplier->events()->updateExistingPivot($eventId, [
                    'description' => $suppliersDescription[$random],
                    'amount'      => rand(1000,3000)
                ]);
            }
        }
    }
}
