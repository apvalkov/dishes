<?php

namespace app\models;

use app\queries\DishQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id
 * @property string $title
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Ingredient[] $ingredients
 */
class Dish extends ActiveRecord
{
    public const STATUS_ACTIVE = 'active';

    public const STATUS_DISABLE = 'disable';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'status'], 'required'],
            [['title', 'status'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::class, ['id' => 'ingredients_id'])->viaTable('dishes_ingredients', ['dishes_id' => 'id']);
    }

    /**
     * Get statuses.
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_DISABLE => Yii::t('app', 'disable'),
            self::STATUS_ACTIVE => Yii::t('app', 'active'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function find()
    {
        return new DishQuery(get_called_class());
    }
}
