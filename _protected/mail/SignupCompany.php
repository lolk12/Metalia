<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 19.05.2017
 * Time: 21:32
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\Company */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl('/admin/#company');
?>

Здравствуйте, вы зарегестрировали компанию <?= Html::encode($user->company_name) ?>!

Для просмотра страницы компании вы можете пройти по этой ссылке

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>
<br>
<p>С уважение Metalia</p>