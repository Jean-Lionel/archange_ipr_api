<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TauxImposamble;

class TauxImposambleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TauxImposamble::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'min_montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'max_montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'taux_imposamble' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
