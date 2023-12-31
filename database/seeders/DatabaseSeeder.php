<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Adresse::factory(10)->create();

        // \App\Models\PaimentIpr::factory(10)->create();
        \App\Models\TauxImposamble::factory(10)->create();

        $this->call([
            \Database\Seeders\AdresseSeeder::class,
        ]);
        \App\Models\Employe::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
