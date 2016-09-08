<?php

/*
|--------------------------------------------------------------------------
| Account Status Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories related to AccountStatus.
|
*/

$factory->define(Iplan\Entity\AccountStatus::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});