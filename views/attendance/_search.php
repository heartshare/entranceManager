<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AttendanceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="attendance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uuid') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'deviceId') ?>

    <?php // echo $form->field($model, 'companyId') ?>

    <?php // echo $form->field($model, 'locationId') ?>

    <?php // echo $form->field($model, 'deviceTime') ?>

    <?php // echo $form->field($model, 'isSync') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
