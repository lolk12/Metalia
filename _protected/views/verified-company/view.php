<?php
use yii\grid\GridView;
use yii\helpers\Html;
use kartik\date\DatePicker;


$user = $modelCompany[0];
?>


<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="main-unit table-data">
            <h3 class="text-center">Информация компании</h3>
            <div class="row">
                <div class="col-sm-4">ИНН/ОГРН</div>
                <div class="col-sm-8"><?= $user['vatin']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Электронная почта</div>
                <div class="col-sm-8"><?= $user['email']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Название компании</div>
                <div class="col-sm-8"><?= $user['company_name']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Номер телефона</div>
                <div class="col-sm-8"><?= $user['phone_number']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Цель</div>
                <div class="col-sm-8"><?= $user['target']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Веб-сайт</div>
                <div class="col-sm-8"><?= $user['web_site']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Штат</div>
                <div class="col-sm-8"><?= $user['staff']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Уставной капитал</div>
                <div class="col-sm-8"><?= $user['initial_capital']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Уставной капитал</div>
                <div class="col-sm-8"><?= $user['initial_capital']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Активы</div>
                <div class="col-sm-8"><?= $user['assets']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Имущество, оборудования</div>
                <div class="col-sm-8"><?= $user['property']?></div>
            </div>
        </div>

        <div class="main-unit">
            <h3 class="text-center">Товары / Услуги</h3>
            <?= GridView::widget([
                'dataProvider' => $modelCompanyRevenue,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'revenue',
                    'year',
                ],
            ]) ?>
        </div>

        <div class="main-unit">
            <h3 class="text-center">Обособленные подразделения</h3>
            <?= GridView::widget([
                'dataProvider' => $modelCompanyUnit,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'address',
                    'telephone',
                    [
                        'attribute'=>'is_main',
                        'label'=>'Главный офис',
                        'format'=>'text', // Возможные варианты: raw, html
                        'content'=>function($data){
                            if($data['is_main'] === 1){
                                return 'Да';
                            }else{
                                return 'Нет';
                            }
                        },
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="text-center">
    <?= Html::a('Верифицировать', '/verified-company/verified?id='.$id,[
            'class' => 'btn btn-primary'
    ])?>

</div>

