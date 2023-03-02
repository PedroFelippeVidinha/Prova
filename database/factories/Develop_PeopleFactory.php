<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class Develop_PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            'cpf'=> $this->faker->regexify('[0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[\-]?[0-9]{2}'),
            "email" => $this->faker->unique()->safeEmail(),
            "date_birth" => $this->faker->unique()->safeEmail(),
            "nationality" => $this->faker->nationality()
        ];
    }
}
