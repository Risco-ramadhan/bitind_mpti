<?php

namespace Database\Factories;

use App\Models\Timeline;
use Illuminate\Database\Eloquent\Factories\Factory;

class RevisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'timelineid'            => Timeline::all()->random()->id,
            'description_revision'  => $this->faker->text,
            'image_revision'        => '',
            'status_revision'       => $this->faker->boolean($chanceOfGettingTrue = 50)
        ];
    }
}
