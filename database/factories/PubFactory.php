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

$factory->define(App\Pub::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,25),
        'caption' => $faker->sentence,
        'type' => $faker->boolean,
        'filename' => str_random(15)->$faker->fileExtension,
        'category' => $faker->word,
        'sub_category' => $faker->word,
        'priority' => $faker->numberBetween(0,3),
        'views' => $faker->randomDigitNotNull,
        'ratings' => $faker->randomDigitNotNull
    ];
});
