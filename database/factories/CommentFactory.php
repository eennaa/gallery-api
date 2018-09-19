<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text(999),
        'user_id' => $faker->numberBetween(1, 40),
        'gallery_id' => $faker->numberBetween(1, 50)
    ];
});
