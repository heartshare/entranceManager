<?php

use app\components\Constant;
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

            [
                'attribute' => 'company.name',
                'header' => 'Company',
                'value' => function ($model) {
                    return $model->company->name;
                }
            ],
            [
                'attribute' => 'isPrimary',
                'value' => function ($model) {
                    return Constant::DEVICE_TYPE[$model->isPrimary];
                }
            ],
            'ip',
            'port',
            'serialNumber',
            'deviceModel',
            [
                'attribute' => 'deviceStatus',
                'value' => function ($model) {
                    return Constant::DEVICE_STATUS_LIST[$model->deviceStatus];
                }
            ],

            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Constant::DEVICE_STATE[$model->status];
                }
            ],
            'lastConnectedAt',
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
