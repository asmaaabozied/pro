<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Voucher;
use Faker\Generator as Faker;

$factory->define(Voucher::class, function (Faker $faker) {

    return [
        'title_en' => $faker->word,
        'description_en' => $faker->text,
        'rate' => $faker->randomDigitNotNull,
        'start_date' => $faker->word,
        'end_date' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
