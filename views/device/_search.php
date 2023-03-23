<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DeviceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uuid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'osVersion') ?>

    <?php // echo $form->field($model, 'platform') ?>

    <?php // echo $form->field($model, 'fmVersion') ?>

    <?php // echo $form->field($model, 'serialNumber') ?>

    <?php // echo $form->field($model, 'deviceModel') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'lastConnectedAt') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
