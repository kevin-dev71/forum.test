<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => \App\User::all()->random()->id,
        'forum_id' => \App\Forum::all()->random()->id,
        'title' => $title,
        "slug" => str_slug($title, '-'),
        'description' => $faker->paragraph,
        'attachment' => \Faker\Provider\Image::image(storage_path() . '/app/posts', 200,200, 'technics', false)
    ];
});
