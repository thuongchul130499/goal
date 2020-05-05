<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'note' => $faker->text,
        'progress' => $faker->randomNumber(),
        'status' => $faker->randomNumber(),
    ];
});
