<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'dishes_id' => $faker->randomElement(range(1, 19)),
    'ingredients_id' => $faker->randomElement(range(1, 99)),
];