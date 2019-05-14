<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Dish */
/* @var $form yii\widgets\ActiveForm */
/* @var $statuses array */
/* @var $ingredients array */
?>

<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($statuses, ['prompt' => Yii::t('app', 'Select a status')]) ?>

    <?= $form->field($model, 'ingredientIds')->widget(Select2::class, [
        'data' => $ingredients,
        'pluginOptions' =>
            [
                'multiple' => true
            ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
