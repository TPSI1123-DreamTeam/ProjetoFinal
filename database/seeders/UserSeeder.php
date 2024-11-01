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
        $user = User::create([
            'name'       => 'Gilberto',
            'email'      => 'gil@atec.pt',
            'password'   => Hash::make('123123123')             
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Rafael',
            'email'      => 'rafael@atec.pt',
            'password'   => Hash::make('123123123')             
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Pedro',
            'email'      => 'pedro@atec.pt',
            'password'   => Hash::make('123123123')             
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Vasco',
            'email'      => 'vasco@atec.pt',
            'password'   => Hash::make('123123123')             
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

        $user = User::create([
            'name'       => 'Rangel',
            'email'      => 'rangel@atec.pt',
            'password'   => Hash::make('123123123')             
        ]);

        $roles = Role::find(3); // role - USER 1, Manager 2, admin 3
        $user->roles()->attach(1);

    }
}