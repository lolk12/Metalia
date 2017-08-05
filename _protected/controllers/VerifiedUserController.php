<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use Yii;
class VerifiedUserController extends Controller
{
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }
    public $layout = 'admin';

    public function actionIndex(){
        $modelUser = new User();
        $queryUser = $modelUser::find()
            ->where(['status' => $modelUser::STATUS_WAIT]);

        $modelUser = new ActiveDataProvider([
            'query' => $queryUser,
        ]);

        return $this->render('index',[
            'modelUser' => $modelUser,
        ]);
    }

    public function actionVerified($id){
        $modelUser = new User();
        $status = $modelUser::STATUS_ACTIVE;
        $modelUser = $modelUser::find()
            ->where(['id' => $id])
            ->all();
        $modelUser[0]['status'] = $status;
        if($modelUser[0]->save()){
            return $this->redirect('/verified-user/index');
        }
    }

    public function actionDelete($id){
        $modelUser = new User();
        $status = $modelUser::STATUS_DELETED;
        $modelUser = $modelUser::find()
            ->where(['id' => $id])
            ->all();
        $modelUser[0]['status'] = $status;
        if($modelUser[0]->save()){
            return $this->redirect('index');
        }
    }

    public function actionView($id){
        $modelUser = new User();
        $modelUser = $modelUser::find()
            ->where(['id' => $id])
            ->all();
        return $this->render('view',[
            'modelUser' => $modelUser
        ]);
    }
}