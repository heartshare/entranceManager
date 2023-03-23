<?php

use app\models\Device;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\DeviceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Devices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Device'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',

//            [
//                'attribute' => 'company.name',
//                'header' => 'Company',
//                'value' => function ($model) {
//                    return $model->company0->name;
//                }
//            ],
//
//            [
//                'attribute' => 'location.location',
//                'header' => 'Location',
//                'value' => function ($model) {
//                    return $model->location0->location;
//                }
//            ],
            [
                'attribute' => 'isPrimary',
                'value' => function ($model) {
                    return $model->isPrimary ? "Primary" : "Secondary";
                }
            ],
            'ip',
            'port',
            //'version',
            //'osVersion',
            //'platform',
            //'fmVersion',
            'serialNumber',
            'deviceModel',
            [
                'attribute' => 'deviceStatus',
                'value' => function ($model) {
                    if ($model->status === 0) {
                        return "Disconnected";
                    } else if ($model->status === 1) {
                        return "Connected";
                    } else if ($model->status === 3) {
                        return "Communication Error";
                    } else {
                        return "Unknown";
                    }
                }
            ],

            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status ? "Active" : "Inactive";
                }
            ],
            'lastConnectedAt',
            //'createdAt',
            //'updatedAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Device $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
