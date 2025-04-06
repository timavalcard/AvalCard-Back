<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use CMS\Category\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        "type"=>"article",
        "name"=>$faker->text(10),
        "slug"=>\Illuminate\Support\Str::slug($faker->text(10)),
        "parent"=>"0"
    ];
});
