<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Reaction;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => Author::factory(),
            'source_id' => Source::factory(),
            'reaction_id' => Reaction::factory(),
            'url' => $this->faker->url(),
            'type' => $this->faker->title()
        ];
    }
}
