<?php

namespace Database\Factories;

use App\Models\profession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\profession>
 */
class professionFactory extends Factory
{
    protected $model = profession::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_prof'=>fake()->jobTitle(),
        ];
    }
}
