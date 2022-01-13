<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Capon;
use Faker\Generator as Faker;

$factory->define(Capon::class, function (Faker $faker) {

    return [
        'title_ar' => $faker->word,
        'title_en' => $faker->word,
        'discount' => $faker->word,
        'start_at' => $faker->word,
        'end_at' => $faker->word,
        'condition_ar' => $faker->word,
        'condition_en' => $faker->word,
        'image_id' => $faker->randomDigitNotNull,
        'old_price' => $faker->word,
        'description' => $faker->word,
        'new_price' => $faker->word,
        'view' => $faker->randomDigitNotNull,
        'image' => $faker->word,
        'category_id' => $faker->randomDigitNotNull,
        'store_id' => $faker->randomDigitNotNull,
        'city_id' => $faker->randomDigitNotNull,
        'active' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
