<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CartItem;
use Faker\Generator as Faker;

$factory->define(CartItem::class, function (Faker $faker) {

    return [
        'cart_id' => $faker->randomDigitNotNull,
        'product_id' => $faker->randomDigitNotNull,
        'quantity' => $faker->randomDigitNotNull,
        'price' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
