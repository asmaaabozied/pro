<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'account_type' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'email' => $faker->word,
        'password' => $faker->word,
        'image' => $faker->word,
        'mobile' => $faker->word,
        'country_id' => $faker->randomDigitNotNull,
        'city_id' => $faker->randomDigitNotNull,
        'address' => $faker->word,
        'mobile_verified' => $faker->word,
        'email_verified' => $faker->word,
        'activated' => $faker->word,
        'status' => $faker->word,
        'email_verified_at' => $faker->date('Y-m-d H:i:s'),
        'remember_token' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
