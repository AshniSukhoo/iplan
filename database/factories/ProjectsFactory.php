<?php

/**
 *
 * Create testing data with faker for project's table.
 */
$factory->define(Iplan\Entity\Project::class, function (Faker\Generator $faker){

    return [
        'name'        => $faker->sentence($faker->numberBetween(3,6)),
        'description' => $faker->realText($faker->numberBetween(50,100)),

        //Create user_id relationship to project model
        'user_id' => function () {
            return Iplan\Entity\User::inRandomOrder()->first()->id;
        }
    ];

});