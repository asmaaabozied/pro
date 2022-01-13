<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ContactUs;
use Faker\Generator as Faker;

$factory->define(ContactUs::class, function (Faker $faker) {

    return [
        'title_en' => $faker->word,
        'map' => $faker->word,
        'country_id' => $faker->randomDigitNotNull,
        'city_id' => $faker->randomDigitNotNull,
        'address_en' => $faker->word,
        'email' => $faker->word,
        'mobile' => $faker->word,
        'phone' => $faker->word,
        'fax' => $faker->word,
        'pobox' => $faker->word,
        'main' => $faker->word,
        'latitude' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
