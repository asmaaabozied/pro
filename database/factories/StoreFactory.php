<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {

    return [
        'name_en' => $faker->word,
        'description_en' => $faker->text,
        'image' => $faker->word,
        'store_type' => $faker->word,
        'status' => $faker->word,
        'activated' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
