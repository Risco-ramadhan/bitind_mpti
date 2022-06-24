<?php

namespace Database\Factories;

use App\Models\OrderSection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // $orderid = OrderSection::all();
        // $orderids = $orderid->get->id;

        $sales = [
            'orderid'           => OrderSection::all()->random()->id,
            'status_pembayaran' => $temp = $this->faker->boolean($chanceOfGettingTrue = 50),
            'status_product'    => ($temp == 1) ? TRUE : FALSE,
        ];

        // OrderSection::whereIn('', Products::where('orderod', Auth::id())->pluck('id')->toArray())->latest();


        return $sales;
    }
}
