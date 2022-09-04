<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Settlement;
use Faker\Generator as Faker;

$factory->define(Settlement::class, function (Faker $faker) {
    $price = $faker->numberBetween($min = 100, $max = 99999);
    $settlement_fee = $price * 0.0325;

    return [
        //
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'item_id' => $faker->numberBetween($min = 1, $max = 50),
        'payment_id' => $faker->numberBetween($min = 1, $max = 10),
        'brand' => 'VISA',
        'last_4' => $faker->numberBetween($min = 1000, $max = 9999),
        'price' => $price,
        'settlement_fee' => $settlement_fee,
        'platform_fee' => ($price - $settlement_fee) * 0.1,
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
