<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dish;
use yii\data\ArrayDataProvider;
use yii\data\BaseDataProvider;
use yii\db\Expression;
use yii\db\Query;
use Yii;

/**
 * DishSearch represents the model behind the search form of `app\models\Dish`.
 */
class DishSearch extends Dish
{
    private const MIN_INGREDIENTS = 2;

    public $ingredientIds;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['ingredientIds', 'required'],
            ['ingredientIds', function ($attribute, $params) {
                if(count($this->ingredientIds) < self::MIN_INGREDIENTS){
                    $this->addError('ingredientIds', \Yii::t('app', 'Select more 2 ingredients'));
                }
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            'ingredientIds' => Yii::t('app', 'Ingredients'),
        ], parent::attributeLabels());
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return BaseDataProvider
     */
    public function search($params)
    {
        $query = Dish::find()->select('dishes.*')->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return new ArrayDataProvider();
        }

        $query->addSelect([
            'countIngredients' => (new Query())
                ->select(new Expression('COUNT(*)'))
                ->from('dishes_ingredients')
                ->where(['dishes_id' => new Expression('dishes.id'), 'ingredients_id' => $this->ingredientIds])
        ]);

        $queryClone = clone $query;

        $queryClone->andFilterHaving([
            '=', 'countIngredients', count($this->ingredientIds)
        ]);

        if ($queryClone->count() > 0) {
            $dataProvider->query = $queryClone;
        } else {
            $query->andFilterHaving([
                '>=', 'countIngredients', self::MIN_INGREDIENTS
            ]);
        }

        $query->orderBy('countIngredients DESC');

        return $dataProvider;
    }
}