<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayCategory = [
            0 => 'Concerto',
            1 => 'Casamento',
            2 => 'Workshop',
            3 => 'Teatro',
            4 => 'Festival',
            5 => 'Evento Corporativo',
            6 => 'Festas Privadas'            
        ];

        for ($i = 0; $i < 7; $i++) {
            Category::create([   
                'description'  => $arrayCategory[$i]  
            ]);          
        }
    }
}
