<?php

namespace app\modules\admin\services;

use app\models\Dish;
use app\models\Ingredient;

/**
 * Service for ingredient.
 */
class IngredientService
{

    /**
     * Update ingredient.
     *
     * @param Ingredient $ingredient
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function update(Ingredient $ingredient)
    {
        if ($ingredient->save()) {
            if ($ingredient->isDisable()) {
                Dish::updateAll(
                    ['status' => Dish::STATUS_DISABLE],
                    ['id' => $ingredient->getDishes()->select('id')->column()]
                );
            }

            return true;
        }

        return false;
    }
}