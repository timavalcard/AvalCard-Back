<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Menu::class, function (Faker $faker) {
    return [
        "parent"=>0,
        "link"=>"",
        "name"=>$faker->text(10),
        "order"=>random_int(1,10)
    ];
});
