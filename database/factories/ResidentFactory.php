<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Resident;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Resident::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);

    return [
        'fio' => $faker->title($gender) . ' ' . $faker->firstName($gender) . ' ' . $faker->lastName(),
        'area' => $faker->numberBetween(500, 9000),
        'start_date' => Carbon::now()->toDateTimeLocalString(),
    ];
});
