<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use CMS\Menu\Models\Menu;

$factory->define(Menu::class, function (Faker $faker) {
    return [
        "parent"=>0,
        "link"=>"",
        "name"=>$faker->text(10),
    ];
});
