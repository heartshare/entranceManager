<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Attendance $model */

$this->title = Yii::t('app', 'Create Attendance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
