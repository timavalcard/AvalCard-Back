<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use CMS\Comment\Models\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "user_id"=>1,
        "post_id"=>1,
        "text"=>$faker->text(20),

    ];
});
