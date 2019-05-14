<?php

namespace app\modules\admin\services;

use app\models\Ingredient;
use app\modules\admin\models\forms\DishForm;
use yii\helpers\ArrayHelper;

/**
 * Service for dishes
 */
class DishService
{
    /**
     * Create dish.
     *
     * @param DishForm $form
     * @return bool
     */
    public function create(DishForm $form)
    {
        if ($form->save()) {
            $this->updateIngredients($form);

            return true;
        }

        return false;
    }

    /**
     * Update dish
     *
     * @param DishForm $form
     * @return bool
     */
    public function update(DishForm $form)
    {
        if ($form->save()) {
            $this->updateIngredients($form);

            return true;
        }

        return false;
    }

    /**
     * @param DishForm $form
     */
    private function updateIngredients(DishForm $form)
    {
        $currentIngredientIds = ArrayHelper::getColumn($form->ingredients, 'id');
        $newIngredientIds = $form->ingredientIds;

        $inserted = array_diff($newIngredientIds, $currentIngredientIds);
        $deleted = array_diff($currentIngredientIds, $newIngredientIds);

        $ingredients = Ingredient::find()->where(['id' => $inserted])->all();

        foreach ($ingredients as $ingredient) {
            $form->link('ingredients', $ingredient);
        }

        \Yii::$app->db
            ->createCommand()
            ->delete('dishes_ingredients', ['dishes_id' => $form->id, 'ingredients_id' => $deleted]);
    }
}