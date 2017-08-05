<?php
use yii\helpers\Html;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $modelCompany,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'vatin',
        'email',
        'company_name',
        'phone_number',
        'initial_capital',
        'updated_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete}',
            'buttons' => [
                'view' => function($url, $model, $key){
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
                }
            ]
        ],
    ],
]);
?>

