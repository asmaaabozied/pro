<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {

    return [
        'store_id' => $faker->randomDigitNotNull,
        'title_en' => $faker->word,
        'description_en' => $faker->text,
        'link' => $faker->word,
        'active' => $faker->word,
        'en' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
