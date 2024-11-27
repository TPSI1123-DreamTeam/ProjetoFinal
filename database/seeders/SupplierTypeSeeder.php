<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupplierType;

class SupplierTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliersList = [
            0 => 'Locação de espaços',
            1 => 'Catering',
            2 => 'Decoração',
            3 => 'Entretenimento',
            4 => 'Serviços técnicos',
            5 => 'Serviços adicionais',
            6 => 'Produção e logística'            
        ];


        for ($i = 0; $i < count($suppliersList); $i++) {    

            SupplierType::create([
                'name'    => $suppliersList[$i],               
            ]);                  
        }
    }
}
