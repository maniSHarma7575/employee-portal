<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\HR\University; 

$factory->define(University::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address'=>$faker->address,
        'rating'=>null
    ];
});
