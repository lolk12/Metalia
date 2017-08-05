<?php
use yii\helpers\Html;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $modelUser,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'full_name',
        'email',
        [
            'attribute'=>'email_confirmed',
            'label'=>'Подтверждение электронной почты',
            'format'=>'text', // Возможные варианты: raw, html
            'content'=>function($data){
                if($data['email_confirmed'] === 1){
                    return 'Да';
                }else{
                    return 'Нет';
                }
            },
        ],
        'updated_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete} {verified}',
            'buttons' => [
                'view' => function($url, $model, $key){
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
                },
                'verified' => function($url, $model, $key){
                    return Html::a('<span class="glyphicon glyphicon-ok" title="Верифицировать пользователя"></span>', $url);
                }
            ]
        ],
    ],
]);
?>