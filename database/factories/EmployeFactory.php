<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Contribuable;
use App\Models\Employe;

class EmployeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employe::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cni' => $this->faker->randomFloat(0, 0, 9999999999.),
            'nom' => $this->faker->word,
            'prenom' => $this->faker->word,
            'status_employe' => $this->faker->word,
            'salaire_base' => $this->faker->randomFloat(0, 0, 9999999999.),
            'frais_deplacement' => $this->faker->randomFloat(0, 0, 9999999999.),
            'indeminite_compansatoire' => $this->faker->randomFloat(0, 0, 9999999999.),
            'avantage_en_nature' => $this->faker->randomFloat(0, 0, 9999999999.),
            'contribuable_id' => Contribuable::factory(),
        ];
    }
}
