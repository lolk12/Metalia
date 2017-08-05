<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 14.07.2017
 * Time: 21:17
 */

namespace app\controllers;

use app\models\TreeMenu;
use yii\web\Controller;
use app\models\Tender\Tender;
use app\models\Tender\TenderProduct;
use app\models\Tender\TenderSignup;
use app\models\User;

use yii\data\ActiveDataProvider;
use Yii;


class VerifiedTenderController extends Controller
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

    public function actionIndex(){
        $modelTender = new Tender();
        $queryTender = $modelTender::find()
            ->where(['verified' => 0])
            ->andFilterWhere(['between','status', TenderSignup::STATUS_NEW, TenderSignup::STATUS_PUBLISHED]);
        $modelTender = new ActiveDataProvider([
            'query' => $queryTender,
        ]);

        return $this->render('index',[
            'modelTender' => $modelTender,
        ]);
    }



    public function actionVerified($id){
        $modelTender = new Tender();
        $modelTenderProduct = new TenderProduct();
        $modelTender = $modelTender::find()->where(['id' => $id])->all();
        $modelTender[0]['verified'] = TenderSignup::VERIFIED_ON;
        if($modelTender[0]->save()){
            return $this->redirect('/verified-tender/index');
        }
    }

    public function actionView($id){
        $modelTender = new Tender();
        $modelTenderProduct = new TenderProduct();
        $modelTreeMenu = new TreeMenu();
        $modelTender = $modelTender::find()->where(['id' => $id])->all();
        $company_id = $modelTender[0]['company_id'];
        $queryTenderProduct = $modelTenderProduct::find()
            ->where(['tender_id' => $id]);
        $modelTenderProduct = new ActiveDataProvider([
            'query' => $queryTenderProduct,
        ]);
        $modelTreeMenu = $modelTreeMenu::find()->all();

        return $this->render('view',[
            'modelTender' => $modelTender,
            'modelTenderProduct' => $modelTenderProduct,
            'modelTreeMenu' => $modelTreeMenu,
            'id' => $id,
            ]);

    }

    public function actionDelete($id){
        $modelTender = new Tender();
        $modelTender = $modelTender::find()
            ->where(['id' => $id])
            ->all();

        $modelTender[0]['status'] = TenderSignup::STATUS_DELETED;
        if($modelTender[0]->save()){
            return $this->redirect('/verified-tender/index');
        }
    }

}