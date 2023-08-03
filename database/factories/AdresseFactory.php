<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Adresse;

class AdresseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adresse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'pays' => $this->faker->word,
            'province' => $this->faker->word,
            'commune' => $this->faker->word,
            'colline' => $this->faker->word,
        ];
    }
}
