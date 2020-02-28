<?php

/** @var Factory $factory */

use App\Commercial;
use App\Photo;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Commercial::class, function (Faker $faker) {
    return [
        Commercial::TITLE => $faker->text(),
        Commercial::PRICE => $faker->numberBetween(21.2, 38401.9),
        Commercial::DESCRIPTION => $faker->sentence(10),
    ];
});

$factory->define(Photo::class, function (Faker $faker) {
    return [
        Photo::CONTENT => $faker->imageUrl(rand(30, 800), rand(40, 1000)),
    ];
});
