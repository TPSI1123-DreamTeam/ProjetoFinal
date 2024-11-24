<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);      
        $this->call(CategorySeeder::class);      
        $this->call(EventSeeder::class);
        //$this->call(SupplierTypeSeeder::class);
        $this->call(SupplierSeeder::class);
        //$this->call(ParticipantSeeder::class);
        //$this->call(InvitationSeeder::class);
        
    }
}
