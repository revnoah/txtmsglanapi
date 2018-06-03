<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'user_id' => function() {
          return factory('App\User')->create()->id;
        },
        'phone_number' => $faker->phoneNumber,
    ];
});
