<?php

use app\models\Location;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\LocationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Locations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Location'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'location',
            'address',
            'status',
            //'createdAt',
            //'updatedAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Location $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->uuid]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
