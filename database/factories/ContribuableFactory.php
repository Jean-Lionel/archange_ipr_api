<?php

namespace Database\Factories;

use App\Models\Adresse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Adress;
use App\Models\Contribuable;

class ContribuableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contribuable::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'adresse_id' => random_int(1,100),
            'nif' => 'NIF-' . $this->faker->randomFloat(0, 0, 9999999999.),
            'damaine_activity' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
