<?php

namespace Database\Seeders;

use App\Models\profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        profession::factory()->count(10)->create();
    }
}
