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

        // $fornecedores = array(
        //     "Locação de espaços/venues" => "salões de festas, hotéis, centros de convenções, etc.",
        //     "Catering" => "empresas de buffet, chefs, bartenders, etc.",
        //     "Decoração" => "floristas, cenógrafos, empresas de locação de móveis e acessórios, etc.",
        //     "Entretenimento" => "bandas, DJs, artistas, mágicos, etc.",
        //     "Serviços técnicos" => "empresa de som e iluminação, empresa de vídeo e filmagem, fotógrafos, etc.",
        //     "Serviços adicionais" => "segurança, transporte, recepcionistas, etc.",
        //     "Produção e logística" => "empresa de montagem e desmontagem, empresa de aluguel de equipamentos, etc."
        //     );


        $suppliersList = [
            0 => 'Locação de espaços',
            1 => 'Catering',
            2 => 'Decoração',
            3 => 'Entretenimento',
            4 => 'Serviços técnicos',
            5 => 'Serviços adicionais',
            6 => 'Produção e logística'            
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
    

        for ($i = 0; $i < 100; $i++) {

            $random = rand(0,6);

            $supplier = Supplier::create([
                'name'    => $suppliersList[$random], //fake()->name(),
                'contact' => (string) fake()->numberBetween(912345678, 936456789),                
                'email'   => fake()->safeEmail(),
                'image'   => $imagesArray[rand(0,5)],
            ]);

            $events = Event::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $supplier->events()->attach($events);
            // $supplier->events()->updateExistingPivot($events, [
            //     'description' => $suppliersDescription[$random],
            //     'amount'      => rand(1000,3000)
            // ]);

            foreach ($events as $eventId) {
                $supplier->events()->updateExistingPivot($eventId, [
                    'description' => $suppliersDescription[$random],
                    'amount'      => rand(1000,3000)
                ]);
            }            
        }
    }
}
