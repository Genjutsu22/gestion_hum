<?php

namespace Database\Seeders;

use App\Models\personne;
use Database\Factories\PersonneFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        personne::factory()->count(10)->create(); 
    }
}
