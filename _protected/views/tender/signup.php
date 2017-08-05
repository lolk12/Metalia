<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use app\assets\AppAssetTender;
use kartik\date\DatePicker;
use app\assets\AppAssetMenu;
AppAssetMenu::register($this);
AppAssetTender::register($this);
?>



<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1 class="text-center">Создания тендра</h1>

        <div class="main-unit">
           <?= $form->field($modelTender, 'type')
            ->radioList([
                '0' => 'Запрос цен',
                '1' => 'Поставка металических изделий',
                '2' => 'Изготовление полуфабрикатов',
                '3' => 'Изготовление готовой продукции',
                '4' => 'Услуги',
            ]);?>
        </div>

        <div class="main-unit ">
            <div class="row">
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <div class="product_id" id="product_id_0">
                                <input name="TenderProductSignup[0][product_id]" type="text">
                            </div>
                            <ul class="catalog" id="catalog_id_0"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">

                    <?= $form->field($modelTenderProduct, '[0]budget')->textInput(['maxlength' => true]) ?>

                </div>
            </div>
        </div>
        <div id="unit"></div>
        <div class="text-center">
            <div class="btn btn-default" id="add-block">добавить товар</div>
        </div>

        <div class="main-unit">
            <?= $form->field($modelTender, 'value')->textInput(['maxlength' => true]) ?>
            <?= '<label class="control-label">Сроки поставки</label>' ?>
            <?= DatePicker::widget([
                'model' => $modelTender,
                'attribute' => 'delivery_data',
                'name' => 'birth_date',
                'readonly' => true,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yy/mm/dd'
                ]
            ]); ?>
            <?= $form->field($modelTender, 'delivery_site')->textInput(['maxlength' => true]) ?>
        </div>
        <?= $form->field($modelTender, 'comments')->widget(Widget::className(), [
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
                <input type="checkbox" name="TenderSignup[status]"><label>Опубликовать сразу</label>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<?php ActiveForm::end(); ?>
