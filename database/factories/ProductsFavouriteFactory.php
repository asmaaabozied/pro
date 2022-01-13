<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductsFavourite;
use Faker\Generator as Faker;

$factory->define(ProductsFavourite::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'ip' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
