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
            'company0.name',
            'location0.location',
            'ip',
            'port',
            'version',
            //'osVersion',
            //'platform',
            //'fmVersion',
            'serialNumber',
            'deviceModel',
            [
                'attribute' => 'deviceStatus',
                'header'=>'Device',
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
                    if ($model->status === 0) {
                        return "Inactive";
                    } else {
                        return "Active";
                    }
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
