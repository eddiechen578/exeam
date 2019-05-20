<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Entities\Product::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->name, ""),
//        'category_id' => \App\Entities\Category::pluck('id')->random(),
        'description' => rtrim($faker->sentence(rand(5,10)), ""),
        'rating' => rand(0, 5),
        'sold_count' => rand(0, 100),
        'review_count' => rand(0, 100),
        'price' => rand(1000, 1500),
        'on_sale' => rand(0, 1)
    ];
});
