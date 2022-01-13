<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderAction;
use Faker\Generator as Faker;

$factory->define(OrderAction::class, function (Faker $faker) {

    return [
        'order_id' => $faker->randomDigitNotNull,
        'reason_id' => $faker->randomDigitNotNull,
        'detail' => $faker->text,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
