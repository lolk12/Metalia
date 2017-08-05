<?php
use yii\grid\GridView;
use yii\helpers\Html;
use kartik\date\DatePicker;

$treeMenu = $modelTreeMenu;
$tender = $modelTender[0];

if($tender['type'] === 0){
    $tender['type'] = 'Запрос цен';
}else if($tender['type'] === 1){
    $tender['type'] = 'Поставка металических изделий';
}else if($tender['type'] === 2){
    $tender['type'] = 'Изготовление полуфабрикатов';
}else if($tender['type'] === 3){
    $tender['type'] = 'Изготовление готовой продукции';
}else if($tender['type'] === 4){
    $tender['type'] = 'Услуги';
}
?>

<?= "<h1 class='text-center'>Тендер # $tender[id]</h1>"?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="main-unit">
            <h3 class="text-center">Товары / Услуги</h3>
            <?= GridView::widget([
                'dataProvider' => $modelTenderProduct,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'product_id',
                        'label'=>'Наименование продукта',
                        'format'=>'text', // Возможные варианты: raw, html
                        'content' => function($data) use ($modelTreeMenu) {

                            foreach ($modelTreeMenu as $key){
                                if($key['id'] === $data['product_id']){
                                    return $key['name'];
                                }
                            }

                        },
                    ],
                    'budget',
                ],
            ]) ?>
        </div>
        <div class="main-unit table-data">
            <h3 class="text-center">Информация о тендре</h3>
            <div class="row">
                <div class="col-sm-4">Тип тендра</div>
                <div class="col-sm-8"><?= $tender['type']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Сроки поставки</div>
                <div class="col-sm-8"><?= DatePicker::widget([
                        'attribute' => 'delivery_data',
                        'name' => 'birth_date',
                        'value' => $tender['delivery_data'],
                        'disabled' => true,
                        'pluginOptions' => [
                            'format' => 'mm/dd/yy'
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">Место поставки</div>
                <div class="col-sm-8"><?= $tender['delivery_site']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Коментарии</div>
                <div class="col-sm-8"><?= $tender['comments']?></div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<?php
    if($company_id === Yii::$app->user->identity->company_id){
        echo '<div class="text-center">';
            echo Html::a('Опубликовать тендер', '/tender/push?id='.$id, [
                'class' => 'btn btn-primary'
            ]);
        echo '</div>';
    }

?>

