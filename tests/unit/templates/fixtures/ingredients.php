<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'title' => $faker->unique()->streetName,
    'status' => $faker->randomElement(\app\models\Ingredient::getStatuses()),
    'created_at' => $date = $faker->dateTime()->format('Y-m-d H:i:s'),
    'updated_at' => $date
];