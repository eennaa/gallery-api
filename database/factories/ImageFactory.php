<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(720, 540, 'food'),
        'gallery_id' => $faker->numberBetween(1, 50)
    ];
});
