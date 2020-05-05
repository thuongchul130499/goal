<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'image' => $faker->word,
        'description' => $faker->text,
        'progress' => $faker->randomNumber(),
        'user_id' => factory(\App\User::class),
        'due_to' => $faker->date(),
        'started_at' => $faker->dateTime(),
    ];
});
