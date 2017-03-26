<?php

/*
 * Create testing data with faker for user's table.
 */
$factory->define(Iplan\Entity\User::class, function (Faker\Generator $faker){
    static $password;

    return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'job_title'         => $faker->jobTitle,
        'company_name'      => $faker->company,
        'bio'               => $faker->realText($faker->numberBetween(50,100)),
        'email'             => $faker->unique()->safeEmail,
        'password'          => $password ?: $password = bcrypt('123456'),
        'account_status_id' => 1,
        'remember_token'    => str_random(10),
    ];
});