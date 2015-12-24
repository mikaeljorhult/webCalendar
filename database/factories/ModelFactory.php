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

$factory->define(WebCalendar\User::class, function (Faker\Generator $faker) {
    return [
        'username' => str_random(5),
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});

$factory->define(WebCalendar\Course::class, function (Faker\Generator $faker) {
    return [
        'name' => trim($faker->sentence(rand(1, 3)), ' .'),
        'code' => $faker->unique()->bothify('??#0##')
    ];
});

$factory->define(WebCalendar\Module::class, function (Faker\Generator $faker) {
    $start_date = $faker->dateTimeBetween('-1 month', '+1 month');

    return [
        'name' => trim($faker->sentence(rand(1, 3)), ' .'),
        'start_date' => $start_date->format('Y-m-d'),
        'end_date' => $faker->dateTimeBetween($start_date, '+1 month')->format('Y-m-d'),
        'type' => 'google',
        'calendar' => 'http://google.se'
    ];
});

$factory->define(WebCalendar\Lesson::class, function (Faker\Generator $faker) {
    $date = $faker->dateTimeBetween('-1 month', '+1 month');

    $startTime = $faker->dateTimeBetween(
        $date->format('Y-m-d 00:00:00'),
        $date->format('Y-m-d 23:00:00')
    );

    $endTime = $faker->dateTimeBetween(
        $startTime,
        $date->format('Y-m-d 23:59:59')
    );

    return [
        'module_id' => 0,
        'title' => trim($faker->sentence(rand(1, 5)), ' .'),
        'location' => $faker->word() . ', Mediehuset',
        'description' => $faker->paragraph(),
        'start_time' => $startTime,
        'end_time' => $endTime,
    ];
});