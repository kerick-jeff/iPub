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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'profile_picture' => $faker->image($dir = null, $width = 640, $height = 480, $category = null, $fullPath = true),
        'description' => $faker->sentence,
        'country' => $faker->country,
        'country_code' => $faker->countryCode,
        'stars' => $faker->numberBetween(1,5),
        'geo_latitude' => $faker->latitude,
        'geo_longitude' => $faker->longitude,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});
