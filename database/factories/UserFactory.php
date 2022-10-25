<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            /* 'leader_id' =>  $faker->numberBetween(1,4), */
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => null,
            'date_admission' =>  $this->faker->date(),
            'password' => Hash::make('asdf1212'), // password
            'remember_token' => null,
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}