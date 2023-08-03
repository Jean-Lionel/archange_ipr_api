<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Contribuable;
use App\Models\Employee;
use App\Models\PaimentIpr;

class PaimentIprFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaimentIpr::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'contribuable_id' => Contribuable::factory(),
            'employe_id' => Employee::factory(),
            'date_paiement' => $this->faker->date(),
            'montant_employe' => $this->faker->randomFloat(0, 0, 9999999999.),
            'montant_employeur' => $this->faker->randomFloat(0, 0, 9999999999.),
            'total_paiement' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
