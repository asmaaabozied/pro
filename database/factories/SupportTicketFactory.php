<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SupportTicket;
use Faker\Generator as Faker;

$factory->define(SupportTicket::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'email' => $faker->word,
        'phone' => $faker->word,
        'type' => $faker->word,
        'message' => $faker->text,
        'responded' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
