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
    public function definition(?string $dir = null,
                                int $width = 640,
                                int $height = 480,
                                ?string $category = null,
                                bool $fullPath = true,
                                bool $randomize = true,
                                ?string $word = null,
                                bool $gray = false,
                                string $format = 'png')
    {
        return [
            'timelineid'            => Timeline::all()->random()->id,
            'description_revision'  => $this->faker->text,
            'image_revision'        => $this->faker->image(null, 360, 360, 'animals', true),
            'status_revision'       => $this->faker->boolean($chanceOfGettingTrue = 50)
        ];
    }
}
