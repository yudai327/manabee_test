<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->realText(50),
        'user_id' => $faker->numberBetween($min = 1, $max = 3),
        'detail' => $faker->realText(200),
        'price' => $faker->numberBetween($min = 0, $max = 99999),
        'path' => '1239',
        'image_path' => null,
        'preview_id' => null,
        'preview_flg' => '0',
        'release_flg' => $faker->numberBetween($min = 0, $max = 1),
        'convert_flg' => $faker->numberBetween($min = 0, $max = 1),
        'delete_flg' => $faker->numberBetween($min = 0, $max = 1),
        'delete_flg' => $faker->numberBetween($min = 0, $max = 1),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
