<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        "user_id"=>1,
        "post_id"=>1,
        "text"=>$faker->text(20),
        
    ];
});
