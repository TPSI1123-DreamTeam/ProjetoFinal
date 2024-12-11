<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\Event;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 2000; $i++) {

            $participant = Participant::create([
                'name'         => fake()->name(),
                'phone'        => (string) fake()->numberBetween(912345678, 936456789),
                'email'        => fake()->unique()->safeEmail(),
                'confirmation' => (string) fake()->numberBetween(0, 1),
            ]);

            $events = Event::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $participant->events()->attach($events);
        }
    }
}
