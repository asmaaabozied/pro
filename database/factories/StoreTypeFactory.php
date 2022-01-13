<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StoreType;
use Faker\Generator as Faker;

$factory->define(StoreType::class, function (Faker $faker) {

    return [
        'type_en' => $faker->word,
        'active' => $faker->word,
        'en' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
