<?php

namespace Database\Seeders;

use App\Models\TauxImposamble;
use Illuminate\Database\Seeder;

class TauxImposambleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TauxImposamble::factory()->count(5)->create();
    }
}
