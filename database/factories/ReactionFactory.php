<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comments' => $this->faker->randomNumber(4),
            'likes' => $this->faker->randomNumber(6),
            'dislikes' => $this->faker->randomNumber(5),
            'reposts' => $this->faker->randomNumber(3)
        ];
    }
}
