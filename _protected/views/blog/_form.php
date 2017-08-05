<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_text')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'pastePlainText' => true,
                'buttonSource' => true,
                   'plugins' => [
                       'clips',
                       'fullscreen',
                   ],
                'imageUpload' => Url::to(['/blog/image-upload']),
                'fileUpload' => Url::to(['/default/file-upload']),
                'imageManagerJson' => Url::to(['/blog/images-get']),
                'fileManagerJson' => Url::to(['/blog/file-upload']),
            ]
        ]); ?>

    <?= $form->field($model, 'full_text')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 600,
                'plugins' => [
                    'clips',
                    'fullscreen',
                ],
                'imageUpload' => Url::to(['/blog/image-upload']),
                'fileUpload' => Url::to(['/default/file-upload']),
                'imageManagerJson' => Url::to(['/blog/images-get']),
                'fileManagerJson' => Url::to(['/blog/file-upload']),
            ]
        ]);
     ?>

    <?= $form->field($model, 'active')->dropDownList(['ВКЛ','ВЫКЛ']) ?>

    <?//= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
    <?//= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>


    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Изменить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
