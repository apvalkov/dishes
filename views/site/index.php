<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $ingredients array */

$this->title = Yii::t('app', 'Dishes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'ingredients' => $ingredients
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
        ],
    ]); ?>


</div>