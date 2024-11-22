<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
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

        $user = User::create([
            'name'       => 'Gilberto Costa',
            'email'      => 'gil@atec.pt',
            'phone'      => (string) fake()->numberBetween(912345678, 936456789),
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[2],
            'role_id'    => 2
        ]);

        $user = User::create([
            'name'       => 'Rafael Rodrigues',
            'email'      => 'rafael@atec.pt',
            'phone'      => (string) fake()->numberBetween(912345678, 936456789),
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4],
            'role_id'    => 1          
        ]);

        $user = User::create([
            'name'       => 'Pedro Ferreira',
            'email'      => 'pedro@atec.pt',
            'phone'      => (string) fake()->numberBetween(912345678, 936456789),
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[2],
            'role_id'    => 2               
        ]);

        $user = User::create([
            'name'       => 'Vasco Sousa',
            'email'      => 'vasco@atec.pt',
            'phone'      => (string) fake()->numberBetween(912345678, 936456789),
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4],
            'role_id'    => 3               
        ]);

        $user = User::create([
            'name'       => 'Eliezer Rangel',
            'email'      => 'rangel@atec.pt',
            'phone'      => (string) fake()->numberBetween(912345678, 936456789),
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4],
            'role_id'    => 3               
        ]);

        for ($i = 0; $i < 50; $i++) {

            $participant = User::create([
                'name'         => fake()->name(),                
                'email'        => fake()->unique()->safeEmail(),
                'phone'        => (string) fake()->numberBetween(912345678, 936456789),
                'password'     => Hash::make('123123123'),
                'image'        => $imagesArray[rand(0, 5)],
                'role_id'      => 4  
            ]); 
        }
    }    
}