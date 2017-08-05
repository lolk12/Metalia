<?php
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use \yii\bootstrap\NavBar;

use \yii\bootstrap\Nav;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= Html::csrfMetaTags() ?>
    <title>Metalia</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div off-canvas="slidebar-1 right shift">
    <i class="icon-remove"></i>
    <ul class="menu mobile" >
        <?php include __DIR__ . '/../site/nav.php'; ?>
    </ul>
</div>

<nav class="col-md-12">
    <img src="/themes/light/site/img/022-170x128.jpg" class="logo">
    <input type="text" name="serch" placeholder="Поиск">
    <ul class="main-menu" >
        <?php include __DIR__ . '/../site/nav.php'; ?>
    </ul>
    <span class="open-left-slidebar"><span class="glyphicon glyphicon-menu-hamburger "></span><span>Меню</span></span>

</nav>
<div canvas="container" id="main">
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>