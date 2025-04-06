<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use CMS\Page\Models\Page;

$factory->define(Page::class, function (Faker $faker) {
  return [
        "title"=>$faker->text(20),
        "post_excerpt"=>$faker->text("200"),
        "content"=>$faker->text(900),
        "user_id"=>1,
        "thumbnail"=>""
    ];
});
