<?php
use app\assets\AppAssetAdmin;
use vova07\imperavi\Asset;
use yii\helpers\Url;
use app\helpers\MenuHelper;
use \yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use \yii\widgets\Menu;
AppAssetAdmin::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="SBAdmintps://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="SBAdmintps://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php $this->head() ?>
<body>
<?php $this->beginBody() ?>
    <?= Html::csrfMetaTags() ?>
    <div class="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin/index/">Metalia Tender</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li><a href="#">Каталог</a></li>
                <li><a href="#">О сервисе</a></li>
                <li><a href="#">Стань поставщиком</a></li>

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/user-management/auth/logout/"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <div class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                    <?php
                    echo Menu::widget([
                        'items' => MenuHelper::getMainMenuItems(),
                        'options' =>[     // Options это оформление стилей родительского блока в котором лежат Items
                            'id'    => 'side-menu',
                            'class' => 'nav'
                        ],
                        'submenuTemplate' => "<ul class='nav nav-second-level' role='menu'>{items}</ul>", ///submenuTemplate Это оформление стелей под пунктов
                    ]);
                    ?>
                      </li>
                  </ul>
              </div>
              <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        
        <div id="page-wrapper">
            <?= $content ?>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
