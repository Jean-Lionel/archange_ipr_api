<?php

namespace Database\Factories;

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
            'adresse_id' => Adress::factory(),
            'nif' => $this->faker->word,
            'damaine_activity' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
