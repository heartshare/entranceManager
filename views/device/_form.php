<?php

use app\components\Constant;
use app\models\Company;
use app\models\Location;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Device $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'companyId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Company::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select a company'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'locationId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Location::find()->all(), 'id', 'location'),
        'options' => ['placeholder' => 'Select a location'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'port')->textInput() ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => Constant::COMMON_STATUS,
        'options' => ['placeholder' => 'Select a status ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'isPrimary')->widget(Select2::classname(), [
        'data' => Constant::DEVICE_TYPE,
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
