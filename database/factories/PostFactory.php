<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'city_id' => 1,
        'type_id' => 1,
        'title' => $faker->sentence,
        'ingress' => $faker->sentence(10),
        'content' => $faker->text,
        'email' => $faker->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'website' => '',
        'published' => true
    ];
});
