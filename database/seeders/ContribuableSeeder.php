<?php

namespace Database\Seeders;

use App\Models\Contribuable;
use Illuminate\Database\Seeder;

class ContribuableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contribuable::factory()->count(5)->create();
    }
}
