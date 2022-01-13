<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {

    return [
        'country_id' => $faker->randomDigitNotNull,
        'name_en' => $faker->word,
        'postal_code' => $faker->word,
        'active' => $faker->word,
        'en' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
