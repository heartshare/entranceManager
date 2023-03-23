<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Employee'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Sync Employee'), ['sync'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'userId',
            //'userUid',
            'name',
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    return $model->role ? "SuperAdmin" : "User";
                }
            ],
            //'password',
            'cardNo',
//            [
//                'attribute' => 'finger',
//                'value' => function ($model) {
//                    return $model->finger ? "Yes" : "Sync Need";
//                }
//            ],

            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status === 0) {
                        return "Sync";
                    } elseif ($model->status === 1) {
                        return "FingerSync";
                    } else {
                        return "Completed";
                    }
                }
            ],

            'createdAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
