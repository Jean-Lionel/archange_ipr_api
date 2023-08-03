<?php

namespace Database\Seeders;

use App\Models\PaimentIpr;
use Illuminate\Database\Seeder;

class PaimentIprSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaimentIpr::factory()->count(5)->create();
    }
}
