<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'cart_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'address_id' => $faker->randomDigitNotNull,
        'country' => $faker->word,
        'city' => $faker->word,
        'address' => $faker->word,
        'shipping_cost' => $faker->randomDigitNotNull,
        'discount_type' => $faker->word,
        'discount' => $faker->word,
        'total' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
