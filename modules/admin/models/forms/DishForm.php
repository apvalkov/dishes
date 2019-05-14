<?php

namespace app\modules\admin\models\forms;

use app\models\Dish;
use app\models\Ingredient;
use yii\helpers\ArrayHelper;

/**
 * Class DishForm
 *
 * @package app\modules\admin\models\forms
 */
class DishForm extends Dish
{
    /**
     * @var array
     */
    public $ingredientIds;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge([
            ['ingredientIds', 'required'],
            ['ingredientIds', 'each', 'rule' => ['exist', 'skipOnError' => true, 'targetClass' => Ingredient::class, 'targetAttribute' => ['ingredientIds' => 'id']]]
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            'ingredientIds' => \Yii::t('app', 'Ingredients')
        ], parent::attributeLabels());
    }

    /**
     * {@inheritdoc}
     */
    public function afterFind()
    {
        $this->ingredientIds = ArrayHelper::getColumn($this->ingredients, 'id');

        parent::afterFind();
    }
}