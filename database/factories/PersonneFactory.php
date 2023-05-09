<?php

namespace Database\Factories;

use App\Models\personne;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personne>
 */
class PersonneFactory extends Factory
{
    protected $model = personne::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $i = 1;
        return [
            'id_adresse' => $i,
            'nom' => fake()->firstname(),
            'prenom'=>fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'cin'=> $this->faker->unique()->regexify('[A-Z0-9]{6}'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'// password
        ];
        $i++;
    }
}
