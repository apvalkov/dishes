<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dish */
/* @var $statuses array */
/* @var $ingredients array */

$this->title = Yii::t('app', 'Update Dish: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dishes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'statuses' => $statuses,
        'ingredients' => $ingredients
    ]) ?>

</div>
