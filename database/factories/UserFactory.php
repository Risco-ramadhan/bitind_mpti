<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname'          => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'bussiness_name'    => $this->faker->company,
            'id_country'        => Country::all()->random()->id,
            'id_city'           => City::all()->random()->id,
            'phone_number'      => $this->faker->phoneNumber,
            // 'general_number'    => $this->faker->tollFreePhoneNumber,
            'email_code_verify' =>rand(100000,999999),
            'email_code_expires_at' => now()->addMinutes(10),
            'role' => 2,

        // password
            'remember_token'    => Str::random(10),
        ];

    }//end definition()


}//end class
