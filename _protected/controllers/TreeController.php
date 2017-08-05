<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 11.05.2017
 * Time: 20:38
 */

namespace app\controllers;

use yii\web\Controller;

class TreeController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    public function actionIndex()
    {
        $this->enableCsrfValidation = false;
        return $this->render('index');
    }
}