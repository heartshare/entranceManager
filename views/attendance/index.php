<?php

use app\components\Constant;
use app\models\Attendance;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\AttendanceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Attendances');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Attendance'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'employee.name.',
                'value' => function ($model) {
                    return $model->employee->name;
                }
            ],
            [
                'attribute' => 'state',
                'value' => function ($model) {
                    return Constant::ATTENDANCE_STATE_LIST[$model->state];
                }
            ],
            [
                'attribute' => 'device.name',
                'header' => 'Device',
                'value' => function ($model) {
                    return $model->device->name;
                }
            ],
            [
                'attribute' => 'company.name',
                'header' => 'Company',
                'value' => function ($model) {
                    return $model->company->name;
                }
            ],
            [
                'attribute' => 'location.location',
                'header' => 'Location',
                'value' => function ($model) {
                    return $model->location->location;
                }
            ],
            'deviceTime',
            'isSync',
            'createdAt',
            //'updatedAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Attendance $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
