<?php
use yii\helpers\Html;


$user = $modelUser[0];
?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="main-unit table-data">
            <h3 class="text-center">Пользователе</h3>
            <div class="row">
                <div class="col-sm-4">Электронная почта</div>
                <div class="col-sm-8"><?= $user['email']?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Ф.И.О.</div>
                <div class="col-sm-8"><?= $user['full_name']?></div>
            </div>

        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<a href="" class="btn-danger"></a>
<div class="text-center">
    <?= Html::a('Верифицировать', '/verified-user/verified?id='.$id,[
        'class' => 'btn btn-primary'
    ])?>

</div>