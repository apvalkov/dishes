<?php

namespace app\queries;

use app\models\Ingredient;
use yii\db\ActiveQuery;

/**
 * QueryBuilder for Ingredient model
 */
class IngredientQuery extends ActiveQuery
{

    /**
     * Add status = 'active' condition
     *
     * @return IngredientQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => Ingredient::STATUS_ACTIVE]);
    }
}