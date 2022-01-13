<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StoreSubscription;
use Faker\Generator as Faker;

$factory->define(StoreSubscription::class, function (Faker $faker) {

    return [
        'subscription_id' => $faker->randomDigitNotNull,
        'store_id' => $faker->randomDigitNotNull,
        'actual_price' => $faker->word,
        'price' => $faker->word,
        'period' => $faker->randomDigitNotNull,
        'end_by' => $faker->word,
        'active' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
