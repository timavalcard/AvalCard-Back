<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use CMS\Article\Models\Article;

$factory->define(Article::class, function (Faker $faker) {
    return [
        "title"=>$faker->name('male'),
        "slug"=>$faker->text(20),
        "post_excerpt"=>$faker->text("200"),
        "content"=>$faker->text(900),
        "user_id"=>1,
        "thumbnail"=>""
    ];
});
