<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use app\assets\AppAssetTender;
use kartik\date\DatePicker;
use yii\helpers\VarDumper;

AppAssetTender::register($this);
?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); $i = 0;?>

        <div class="main-unit">
            <?= $form->field($modelTender[0], 'type')
                ->radioList([
                    '0' => 'Запрос цен',
                    '1' => 'Поставка металических изделий',
                    '2' => 'Изготовление полуфабрикатов',
                    '3' => 'Изготовление готовой продукции',
                    '4' => 'Услуги',

                ],['class' => 'radio-list']);?>
        </div>

        <?php foreach ($modelTenderProduct as $key):?>
            <div class="main-unit ">
                <div class="row">
                    <div class="col-md-8">
                        <?= $form->field($key, "[$i]product_id")->dropDownList([
                            '0' => 'Гайкий',
                            '1' => 'Болты',
                            '2' => 'Скобы 50х150',
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($key, "[$i]budget")->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
            </div>
        <?php $i++; endforeach; ?>

        <div class="main-unit">
            <?= $form->field($modelTender[0], 'value')->textInput(['maxlength' => true]) ?>
            <?= '<label class="control-label">Сроки поставки</label>' ?>
            <?= DatePicker::widget([
                'model' => $modelTender[0],
                'attribute' => 'delivery_data',
                'name' => 'birth_date',
                'readonly' => true,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yy/mm/dd'
                ]
            ]); ?>
            <?= $form->field($modelTender[0], 'delivery_site')->textInput(['maxlength' => true]) ?>
        </div>
        <?= $form->field($modelTender[0], 'comments')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'pastePlainText' => true,
                'buttonSource' => true,
                'plugins' => [
                    'clips',
                    'fullscreen',
                ],

            ]
        ]); ?>
        <div class="text-center">
            <div class="send-data">
                <input type="submit" value="Сохранить" class="btn btn-primary ">
                <input type="checkbox" name="Tender[status]"><label>Опубликовать сразу</label>
            </div>
        </div>
    </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-2"></div>
</div>


