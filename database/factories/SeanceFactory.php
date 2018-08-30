<?php

use Faker\Generator as Faker;

$factory->define(App\Seance::class, function (Faker $faker) {
    return [
        'name' => $faker->paragraph,
    ];
});
