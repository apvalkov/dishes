<?php


namespace app\queries;

use app\models\Dish;
use yii\db\ActiveQuery;

/**
 * QueryBuilder for Dish model
 */
class DishQuery extends ActiveQuery
{
    /**
     * Add status = 'active' condition
     *
     * @return DishQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => Dish::STATUS_ACTIVE]);
    }
}