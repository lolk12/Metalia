<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>

    <h1 class="text-center">История тендров</h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute'=>'type',
            'label'=>'Тип тендра',
            'format'=>'text', // Возможные варианты: raw, html
            'content'=>function($data){
                if($data['type'] === 0){
                    return 'Запрос цен';
                }else if($data['type'] === 1){
                    return 'Поставка металических изделий';
                }else if($data['type'] === 2){
                    return 'Изготовление полуфабрикатов';
                }else if($data['type'] === 3){
                    return 'Изготовление готовой продукции';
                }else if($data['type'] === 4){
                    return 'Услуги';
                }
            },
        ],
        'value',
        'delivery_data:date',
        'delivery_site',
        'updated_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function($url, $model, $key){
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
                }
            ]
        ],
    ],
]) ?>