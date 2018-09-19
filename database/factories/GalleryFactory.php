<?php

use Faker\Generator as Faker;

$factory->define(App\Gallery::class, function (Faker $faker) {    
    return [
        'title' => $faker->sentence(3, true),
        'description' => $faker->text(300),
        'user_id' => $faker->numberBetween(1, 40)     
    ];
});
