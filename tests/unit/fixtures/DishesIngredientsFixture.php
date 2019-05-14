<?php

namespace tests\unit\fixtures;

use yii\db\Query;
use yii\test\ActiveFixture;

class DishesIngredientsFixture extends ActiveFixture
{
    public $tableName = 'dishes_ingredients';

    public $depends = [
        DishesFixture::class,
        IngredientsFixture::class
    ];

    public function load()
    {
        $this->data = [];
        $table = $this->getTableSchema();
        foreach ($this->getData() as $alias => $row) {
            if (!(new Query())->from('dishes_ingredients')->where($row)->exists()) {
                $primaryKeys = $this->db->schema->insert($table->fullName, $row);
                $this->data[$alias] = array_merge($row, $primaryKeys);
            }
        }
    }
}