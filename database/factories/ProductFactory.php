<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'category_id' => $faker->randomDigitNotNull,
        'brand_id' => $faker->randomDigitNotNull,
        'title_en' => $faker->word,
        'description_en' => $faker->text,
        'price' => $faker->word,
        'discount' => $faker->word,
        'discount_rate' => $faker->word,
        'discount' => $faker->word,
        'discount_end_date' => $faker->word,
        'active' => $faker->word,
        'en' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
