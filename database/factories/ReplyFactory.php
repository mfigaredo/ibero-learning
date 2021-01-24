<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Models\User;
use App\Models\Reply;
use App\Models\Topic;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'topic_id' => Topic::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'content' =>  $faker->text(),
        'created_at' => now(),
    ];
});
