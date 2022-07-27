<?php

namespace Database\Factories;

use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'source_id' => Source::factory(),
            'auth_source_id' => $this->faker->randomNumber(8),
            'avatar' => $this->faker->filePath()
        ];
    }
}
