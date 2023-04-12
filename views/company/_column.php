<?php

use app\components\Constant;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 6],
        'header' => '',
        ///'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'attribute' => 'name',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 6],
        'header' => '',
        //'headerOptions' => ['class' => 'kartik-sheet-style']
    ],

//    [
//        'class' => 'kartik\grid\BooleanColumn',
//        'attribute' => 'status',
//        'vAlign' => 'middle'
//    ],
    [
        'attribute' => 'status',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 6],
        'header' => '',
        //'headerOptions' => ['class' => 'kartik-sheet-style'],
        'value' => function ($model) {
            return Constant::COMMON_STATUS[$model->status];
        }
    ],

    [
        'attribute' => 'createdAt',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 6],
        'header' => '',
        //'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
//    [
//        'class' => 'kartik\grid\ExpandRowColumn',
//        'width' => '50px',
//        'value' => function ($model, $key, $index, $column) {
//            return GridView::ROW_COLLAPSED;
//        },
//        // uncomment below and comment detail if you need to render via ajax
//        // 'detailUrl' => Url::to(['/site/book-details']),
//        'detail' => function ($model, $key, $index, $column) {
//            return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
//        },
//        'headerOptions' => ['class' => 'kartik-sheet-style'],
//        'expandOneOnly' => true
//    ],


    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdownOptions' => ['class' => 'float-right'],
        'urlCreator' => function ($action, $model, $key, $index) {
            return '#';
        },
        'viewOptions' => ['title' => 'This will launch the book details page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['title' => 'This will launch the book update page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['title' => 'This will launch the book delete action. Disabled for this demo!', 'data-toggle' => 'tooltip'],
        //'headerOptions' => ['class' => 'kartik-sheet-style'],
    ],
    [
        'class' => 'kartik\grid\CheckboxColumn',
        //'headerOptions' => ['class' => 'kartik-sheet-style'],
        'pageSummary' => '<small>(amounts in $)</small>',
        'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
    ]
];

?>