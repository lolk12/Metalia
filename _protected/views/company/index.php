<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetCompanyCard;
AppAssetCompanyCard::register($this);

?>
<div class="tag">
    <ul class="text-center">
        <li><a class="go_to" href="#page_1">Регистрационные и контактные данные</a></li>
        <li><a class="go_to" href="#page_2">Операционные показатели</a></li>
        <li><a class="go_to" href="#page_3">Продукция</a></li>
        <li><a class="go_to" href="#page_4">Услуги</a></li>
    </ul>
</div>
<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<div class="row full_vertical" id="page_1">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h2 class="text-center">Регистрационные и контактные данные</h2>
        <div class="main-unit ">
            <h3 class="text-center">Основное подразделение</h3>
            <?= $form->field($modelCompanyUnit, '[0]address')->textInput(['maxlength' => true]) ?>
            <?= $form->field($modelCompanyUnit, '[0]name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($modelCompanyUnit, '[0]telephone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($modelCompany, 'web_site')->textInput(['maxlength' => true]) ?>
        </div>
        <div id="unit"></div>
        <div class="text-center">
            <div class="btn btn-default" id="add-unit">Добавить обособленное подразделение подразделение</div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row full_vertical" id="page_2">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h2 class="text-center">Операционные показатели</h2>
        <div class="main-unit">
            <?= $form->field($modelCompany, 'staff')->textInput(['maxlength' => true]) ?>
            <?= $form->field($modelCompany, 'initial_capital')->textInput(['maxlength' => true]) ?>
            <?= $form->field($modelCompany, 'assets')->textInput(['maxlength' => true]) ?>
            <?= $form->field($modelCompany, 'property')->textInput(['maxlength' => true]) ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($modelCompanyRevenue, 'revenue[0]')->textInput(['maxlength' => true])->label($year - 3 ) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($modelCompanyRevenue, 'revenue[1]')->textInput(['maxlength' => true])->label($year - 2 ) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($modelCompanyRevenue, 'revenue[2]')->textInput(['maxlength' => true])->label($year - 1 ) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-2"></div>
</div>

<div class="row full_vertical" id="page_3">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="main-unit">
            <h2 class="text-center big_text">Продукция</h2>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row full_vertical" id="page_4">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="main-unit">
            <h2 class="text-center big_text">Услуги</h2>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="text-center">
    <input type="submit" value="Отправить" class="btn btn-primary ">
</div>
<?php ActiveForm::end(); ?>




