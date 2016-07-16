<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Notification::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,25),
        'body' => $faker->sentences,
        'status' => $faker->boolean,
        'on_board' => $faker->boolean
    ];
});
