<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['default/email-confirm', 'token' => $user->email_confirm_token]);
?>

Здравствуйте, <?= Html::encode($user->full_name) ?>!

Для подтверждения адреса пройдите по ссылке:

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>

Если Вы не регистрировались на нашем сайте, то просто удалите это письмо.