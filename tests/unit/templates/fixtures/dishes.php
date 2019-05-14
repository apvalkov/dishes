<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'title' => $faker->unique()->name,
    'status' => $faker->randomElement(\app\models\Dish::getStatuses()),
    'created_at' => $date = $faker->dateTime()->format('Y-m-d H:i:s'),
    'updated_at' => $date
];