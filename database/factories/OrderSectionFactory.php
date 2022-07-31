<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(
        ?string $dir = '/public/assets/tmp',
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
            'userid'                => User::all()->random()->id,
            'id_product'            => Product::all()->random()->id,
            'domain'                => $this->faker->domainName,
            'color1'                 => $this->faker->hexcolor,
            'color2'                 => $this->faker->hexcolor,
            'color3'                 => $this->faker->hexcolor,
            'url_reference'         => $this->faker->url,
            'image_reference'       => $this->faker->image(null, 360, 360, 'animals', true),
            'bussiness_name'    => $this->faker->bs,
            'description_detail'    => $this->faker->text,
        ];
    }

    public function image(  ?string $dir = null,
                            int $width = 640,
                            int $height = 480,
                            ?string $category = null,
                            bool $fullPath = true,
                            bool $randomize = true,
                            ?string $word = null,
                            bool $gray = false,
                            string $format = 'png')
    {
        # code...
    }
}
