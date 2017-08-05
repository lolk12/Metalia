<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top: 110px;">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php
                use yii\helpers\Url;
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                use \yii\widgets\Pjax;


                ?>
                <?//php Pjax::begin(['id' => 'notes']) ?>
                <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
                <?= $form->field($modelCompany, 'company_name')->textInput() ;?>
                <?= $form->field($modelUser, 'username')->textInput();?>

                <?= $form->field($modelUser, 'full_name')->textInput() ;?>
                <?= $form->field($modelCompany, 'vatin')->textInput() ;?>

                <?= $form->field($modelCompany, 'phone_number')->textInput() ;?>
                <?= $form->field($modelUser, 'password')->passwordInput();?>
                <?= $form->field($modelCompany, 'target')->textarea() ;?>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Зарегистрироваться </button>
                </div>
                <?php ActiveForm::end(); ?>
                <?//php Pjax::end(); ?>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>