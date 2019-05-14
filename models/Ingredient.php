<?php

namespace app\models;

use app\queries\IngredientQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string $title
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Dish[] $dishes
 */
class Ingredient extends ActiveRecord
{
    public const STATUS_ACTIVE = 'active';

    public const STATUS_DISABLE = 'disable';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
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
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getDishes()
    {
        return $this->hasMany(Dish::class, ['id' => 'dishes_id'])->viaTable('dishes_ingredients', ['ingredients_id' => 'id']);
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
        return new IngredientQuery(get_called_class());
    }

    /**
     * Check is disable.
     *
     * @return bool
     */
    public function isDisable()
    {
        return $this->status === self::STATUS_DISABLE;
    }
}
