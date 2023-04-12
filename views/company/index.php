<?php


use kartik\grid\GridView;
use yii\helpers\Html;
/** @var yii\web\View $this */
/** @var app\models\CompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

    echo GridView::widget([
        //'id' => 'kv-grid-demo',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'columns' => $this->render('_column', ['model'=>$searchModel]), // check this value by clicking GRID COLUMNS SETUP button at top of the page
        //'headerContainer' => ['class' => 'kv-table-header'],
        //'containerOptions' => ['class' => 'kv-grid-wrapper'], // fixed height for floated header behavior
        //'floatHeader' => true, // table header floats when you scroll
        //'floatPageSummary' => true, // table page summary floats when you scroll
        //'floatFooter' => false, // disable floating of table footer
        'pjax' => true, // pjax is set to always false for this demo
        // parameters from the demo form
        'responsive' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'hover' => true,
        'showPageSummary' => true,
        'panel' => [
            'after' => '<div class="float-right float-end"><button type="button" class="btn btn-primary" onclick="var keys = $("#kv-grid-demo").yiiGridView("getSelectedRows").length; alert(keys > 0 ? "Downloaded " + keys + " selected books to your account." : "No rows selected for download.");"><i class="fas fa-download"></i> Download Selected</button></div><div style="padding-top: 5px;"><em>* The page summary displays SUM for first 3 amount columns and AVG for the last.</em></div><div class="clearfix"></div>',
            'heading' => '<i class="fas fa-book"></i>  Library',
            'type' => 'primary',
            'before' => '<div style="padding-top: 7px;"><em>* Resize table columns just like a spreadsheet by dragging the column edges.</em></div>',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'exportConfig' => [
            'csv' => [],
            'xls' => [],
            'pdf' => [],
            'json' => [],
        ],
        // set your toolbar
        'toolbar' =>  [
            [
                'content' =>
                    Html::button('<i class="fas fa-plus"></i>', [
                        'class' => 'btn btn-success',
                        'title' => Yii::t('kvgrid', 'Add Book'),
                        'onclick' => 'alert("This should launch the book creation form.\n\nDisabled for this demo!");'
                    ]) . ' '.
                    Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                        'class' => 'btn btn-outline-secondary',
                        'title'=>Yii::t('kvgrid', 'Reset Grid'),
                        'data-pjax' => 0,
                    ]),
                'options' => ['class' => 'btn-group mr-2 me-2']
            ],
            '{export}',
            '{toggleData}',
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        //'itemLabelSingle' => 'book',
        //'itemLabelPlural' => 'books'
    ]);

    ?>

</div>
