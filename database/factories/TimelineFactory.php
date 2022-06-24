<?php

namespace Database\Factories;

use App\Models\OrderSection;
use App\Models\SalesTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statustimeline = SalesTransaction::all();
        $statustimelines = $statustimeline->random()->status_product;

        $revision = OrderSection::all();
        $revisions = $revision->random()->id_product;
        $rev = ['1', '3', '5'];

        $timeline = [
            'id_transaction'    =>  SalesTransaction::all()->random()->id,
            // 'revision'          => $this->faker->randomElement(['1', '3', '5']),
            // 'status_timeline'   =>  (SalesTransaction::all()->random()->status_product == 1) ? 'finish' : $this->faker->randomElement(['prepare', 'building', 'revision']),
            // $this->faker->randomElement(['prepare', 'building', 'revision', 'finish'])
        ];

        if($statustimelines == 1){
            $timeline['status_timeline'] = 'finish';
        }else{
            $timeline['status_timeline'] = $this->faker->randomElement(['prepare', 'building', 'revision']);
        }

        if($revisions == 1){
            $timeline['revision'] = $this->faker->randomElement($rev,1);
        }

        if($revisions == 2){
            $timeline['revision'] = $this->faker->randomElement($rev, 3);
        }

        if ($revisions == 3) {
            $timeline['revision'] = $this->faker->randomElement($rev, 5);
        }

        return $timeline;
    }
}
