<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryAttribute;
use Faker\Generator as Faker;

$factory->define(CategoryAttribute::class, function (Faker $faker) {

    return [
        'category_id' => $faker->randomDigitNotNull,
        'title_en' => $faker->word,
        'description_en' => $faker->text,
        'active' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
