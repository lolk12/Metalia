<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 04.05.2017
 * Time: 20:12
 */

namespace app\controllers;

use yii;
use app\models\SignupCompany;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout  = 'admin';

    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    public function actionIndex() { // Action add admin in database

        return $this->render('index'); /// Render listen the SBAdmin if valid data

    }


    public function  actionSignup()
    {
        $model = new SignupCompany();

        if(isset($_POST['SignupCompany']))
        {

            $model->attributes = Yii::$app->request->post('SignupCompany');
            if ($model->validate() && $model->signup())
            {
                $this->redirect('/admin/index/#goodCompany');
            }
//            else{
//                $this->redirect('#errorCompany');
//            }


        }
        return $this->render('signup',['model'=> $model]);
    }



}