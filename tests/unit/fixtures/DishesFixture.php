<?php

namespace tests\unit\fixtures;

use app\models\Dish;
use yii\test\ActiveFixture;

class DishesFixture extends ActiveFixture
{
    public $modelClass = Dish::class;
}