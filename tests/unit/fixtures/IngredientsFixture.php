<?php

namespace tests\unit\fixtures;

use app\models\Ingredient;
use yii\test\ActiveFixture;

class IngredientsFixture extends ActiveFixture
{
    public $modelClass = Ingredient::class;
}