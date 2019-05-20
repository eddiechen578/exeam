<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Entities\Featured::class, function (Faker $faker) {


    $image = $faker->randomElement([
        asset('images/product1.png'),
        asset('images/product2.png'),
        asset('images/product3.png'),
        asset('images/product4.jpeg'),
        asset('images/product5.png'),
    ]);



    return [
        'name' => $image
    ];
});
