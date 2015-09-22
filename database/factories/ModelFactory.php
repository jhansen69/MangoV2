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
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Job::class, function (Faker\Generator $faker) {
    return [
        'pub_id' => 1,
        'run_id' => 1,
        'user_id' => Auth::id,
        'site_id' => session()->get('site'),
        'type'=>'press',
        'product_date'=> '2015-09-22',
        'request_date'=> '2015-09-22',
        'settings' => [],
        'recurrence_id'=>0,
        'tied_to_id'=>0,
        'equipment_id'=>0,
        'start'=>'2015-09-20 11:30',
        'end'=>'2015-09-20 13:30',
    ];
});

