<?php

namespace Database\Seeders;

use App\Models\adresse;
use Database\Factories\adresseFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        adresse::factory()->count(10)->create();
    }
}
