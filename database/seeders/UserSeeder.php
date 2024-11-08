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
            'name'       => 'Gilberto',
            'email'      => 'gil@atec.pt',
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4]
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Rafael',
            'email'      => 'rafael@atec.pt',
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4]          
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Pedro',
            'email'      => 'pedro@atec.pt',
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4]               
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Vasco',
            'email'      => 'vasco@atec.pt',
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4]               
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Rangel',
            'email'      => 'rangel@atec.pt',
            'password'   => Hash::make('123123123'),
            'image'      => $imagesArray[4]               
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

    }

    
}