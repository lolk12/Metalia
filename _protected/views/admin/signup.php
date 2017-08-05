<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\widgets\Pjax;

?>


<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
        <?//php Pjax::begin(['id' => 'notes']) ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

        <?= $form->field($model, 'email')->input('email');?>
        <?= $form->field($model, 'company_name')->textInput();?>
        <?= $form->field($model, 'vatin')->textInput() ;?>
        <?= $form->field($model, 'notes')->textInput() ;?>
        <?= $form->field($model, 'phone_number')->textInput() ;?>
        <?= $form->field($model, 'legal_address_country')->textInput() ;?>
        <?= $form->field($model, 'legal_address_region')->textInput() ;?>
        <?= $form->field($model, 'legal_address_city')->textInput() ;?>
        <?= $form->field($model, 'legal_address_street')->textInput() ;?>
        <?= $form->field($model, 'actual_address_country')->textInput() ;?>
        <?= $form->field($model, 'actual_address_region')->textInput() ;?>
        <?= $form->field($model, 'actual_address_city')->textInput() ;?>
        <?= $form->field($model, 'actual_address_street')->textInput() ;?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Зарегестрировать компанию </button>
        </div>
        <?php ActiveForm::end(); ?>
        <?//php Pjax::end(); ?>

    </div>
</div>