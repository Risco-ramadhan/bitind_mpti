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
    public function definition()
    {
        return [
            'userid'                => User::all()->random()->id,
            'id_product'            => Product::all()->random()->id,
            'domain'                => $this->faker->domainName,
            'color'                 => $this->faker->hexcolor,
            'url_reference'         => $this->faker->url,
            'image_reference'       => '',
            'bussiness_category'    => $this->faker->bs,
            'description_detail'    => $this->faker->text,
        ];
    }
}
