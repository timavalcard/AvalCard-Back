<?php
use CMS\Tag\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
  return [
        "name"=>$faker->text(20),
        "slug"=>\Illuminate\Support\Str::slug($faker->text(10)),
        "content"=>$faker->text(900),
        "type"=>"article"
    ];
});
