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
        for ($i = 0; $i < 100; $i++) {

            $supplier = Supplier::create([
                'name'    => fake()->name(),
                'contact' => (string) fake()->numberBetween(912345678, 936456789),                
            ]);

            $events = Event::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $supplier->events()->attach($events);
        }
    }
}
