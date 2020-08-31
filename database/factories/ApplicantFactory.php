<?php

use Faker\Generator as Faker;
use App\Models\HR\Applicant;
use App\Models\HR\University;

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'phone' => $faker->phoneNumber,
        'college' => $faker->word,
        'graduation_year' => $faker->year,
        'course' => $faker->word,
        'linkedin' => $faker->url,
        'hr_university_id'=>function () {
            return factory(University::class)->create()->id;
        }
    ];
});
