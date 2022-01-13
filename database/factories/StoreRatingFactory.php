<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StoreRating;
use Faker\Generator as Faker;

$factory->define(StoreRating::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'store_id' => $faker->randomDigitNotNull,
        'rate' => $faker->randomDigitNotNull,
        'review' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
