<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DishSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $ingredients array */
?>

<div class="dish-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ingredientIds')->widget(\kartik\select2\Select2::class, [
        'data' => $ingredients,
        'options' => [
            'multiple' => true,
            'prompt' => Yii::t('app', 'Select ingredients')
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'maximumSelectionLength' => 5
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['site/index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
