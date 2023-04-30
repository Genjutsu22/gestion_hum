<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adresse>
 */
class AdresseFactory extends Factory
{
    protected $model = adresse::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pays'=> fake()->country(),
            'ville'=>fake()->city(),
            'quartier'=>fake()->streetAddress(),
            'code_postal'=>fake()->countryCode(),
        ];
    }
}
