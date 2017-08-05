<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\CompanySignup;

/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, and password reset.
 */
class SiteController extends Controller
{

//    public function actionError()
//    {
//        $exception = Yii::$app->errorHandler->exception;
//        if ($exception !== null) {
//            return $this->render('error', ['exception' => $exception]);
//        }
//    }

   
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionSingin(){

        $modelUser = new Signup();
        $modelCompany = new CompanySignup();
        if (isset($_POST['Signup']) && isset($_POST['CompanySignup']))
        {

            $modelUser->attributes = Yii::$app->request->post('Signup');
            $modelCompany->attributes = Yii::$app->request->post('CompanySignup');

            if ($modelCompany->validate() && $modelCompany->signup($modelUser->getEmail())){
                if ($modelUser->validate() && $modelUser->signup($modelCompany->getId())){
                    $this->redirect('/#good');
                }
            }
        }
        return $this->render('singin',[
            'modelUser' => $modelUser,
            'modelCompany' => $modelCompany,
        ]);

    }


}
