<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SocialMediaLink;
use Faker\Generator as Faker;

$factory->define(SocialMediaLink::class, function (Faker $faker) {

    return [
        'title_en' => $faker->word,
        'link' => $faker->word,
        'icon' => $faker->word,
        'background_color' => $faker->word,
        'class' => $faker->word,
        'active' => $faker->word,
        'descriptopn_en' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
