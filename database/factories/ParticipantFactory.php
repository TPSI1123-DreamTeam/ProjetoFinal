<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Participant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'         => fake()->name(),
            'phone'        => (string) fake()->numberBetween(912345678, 936456789),
            'email'        => fake()->unique()->safeEmail(),
            'confirmation' => (string) fake()->numberBetween(0, 1),
        ];
    }
}
