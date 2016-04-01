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
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'user_session_token' => str_random(60),
        'username'  => $faker->username
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'description' =>  $faker->sentence(100),
        'views' => rand(0, 100)
        
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'comment' => $faker->sentence(100)
    ];
});