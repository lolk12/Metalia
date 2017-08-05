<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 10.07.2017
 * Time: 1:03
 */

namespace app\controllers;

use app\models\Tender\Tender;
use app\models\Tender\TenderFile;
use app\models\Tender\TenderProduct;
use app\models\TreeMenu;
use yii;
use yii\web\Controller;
use app\models\Tender\TenderSignup;
use app\models\Tender\TenderProductSignup;
use app\models\Tender\TenderFileSignup;
use yii\data\ActiveDataProvider;

class TenderController extends Controller
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
        $dataTender = new Tender();
        $query = Tender::find()
        ->where(['company_id'=>Yii::$app->user->identity->company_id])
        ->andFilterWhere(['between','status',TenderSignup::STATUS_NEW, TenderSignup::STATUS_FINISHED]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }
    public function actionAllTender(){
        $dataTender = new Tender();
        $modelTender = new TenderSignup();
        $query = Tender::find()
            ->Where(['status' => $modelTender::STATUS_PUBLISHED]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('all-tender',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionHistory(){
        $dataTender = new Tender();
        $modelTender = new TenderSignup();
        $query = Tender::find()
            ->Where(['status' => $modelTender::STATUS_CANCELLED]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('history',[
            'dataProvider' => $dataProvider
        ]);
    }
    public $enableCsrfValidation = false;

    public function actionSignup ()
    {

        $modelTender = new TenderSignup();
        $modelTenderProduct = new TenderProductSignup();
        $modelTenderFile = new TenderFileSignup();

        if(isset($_POST['TenderSignup']) && isset($_POST['TenderProductSignup']))
        {
            $modelTender->attributes = Yii::$app->request->post('TenderSignup');

            if($modelTender->signup()){

                if($_POST['TenderProductSignup']){
                    for($z = 0; $z<= count($_POST['TenderProductSignup']) - 1 ; $z ++){
                        $modelTenderProduct->attributes = $_POST['TenderProductSignup'][$z];
                        $modelTenderProduct->signup($modelTender->getId());
                    }
                    return $this->redirect('/tender/index');
                }

            }
        }

        return $this->render('signup',[
            'modelTender' => $modelTender,
            'modelTenderProduct' => $modelTenderProduct,
            'modelTenderFile' => $modelTenderFile
        ]);
    }

    public function actionView($id){
        $modelTender = new Tender();
        $modelTenderProduct = new TenderProduct();
        $modelTenderFile = new TenderFile();
        $modelTreeMenu = new TreeMenu();
        $modelTender = $modelTender::find()->where(['id' => $id])->all();
        $company_id = $modelTender[0]['company_id'];
        $queryTenderProduct = $modelTenderProduct::find()->where(['tender_id' => $id]);
        $modelTreeMenu = $modelTreeMenu::find()->all();

        $modelTenderProduct = new ActiveDataProvider([
            'query' => $queryTenderProduct,
        ]);
        $file = yii\web\UploadedFile::getInstance($modelTenderFile, 'file');
        if($file){
            return print_r($file);
        }






        if($modelTender[0]['status'] === TenderSignup::STATUS_NEW){
            if ($company_id === Yii::$app->user->identity->company_id){
                return $this->render('view',[
                    'modelTender' => $modelTender,
                    'modelTenderProduct' => $modelTenderProduct,
                    'id' => $id,
                    'company_id' => $company_id,
                    'modelTreeMenu' => $modelTreeMenu
                ]);
            }else{
                if(Yii::$app->user->identity->superadmin){
                    return $this->render('view',[
                        'modelTender' => $modelTender,
                        'modelTenderProduct' => $modelTenderProduct,
                        'id' => $id,
                        'company_id' => $company_id,
                        'modelTreeMenu' => $modelTreeMenu
                    ]);
                }
            }
        }else{
            if ($modelTender[0]['status'] >= TenderSignup::STATUS_PUBLISHED){
                return $this->render('view',[
                    'modelTender' => $modelTender,
                    'modelTenderProduct' => $modelTenderProduct,
                    'modelTreeMenu' => $modelTreeMenu
                ]);
            }else{
                return $this->redirect('index');
            }
        }

    }

    public function actionFileUpload(){
        $modelFile = new TenderFile();

        $file = yii\web\UploadedFile::getInstance($modelFile, 'file');


        return yii\helpers\Json::encode([
            'files' => [
                [
                    'name' => $file->name,
                    'size' => $file->size,
                    'deleteType' => 'POST',
                ]
            ],
            'files_bin' =>[
                'file' => $_FILES
            ]
        ]);

    }

    public function actionUpdate($id){
        $modelTender = new Tender();
        $modelTenderProduct = new TenderProduct();
        $modelTender = $modelTender::find()->where(['id' => $id])->all();
        $modelTenderProduct = $modelTenderProduct::find()->where(['tender_id' => $id])->all();

        if ($modelTender[0]['company_id'] === Yii::$app->user->identity->company_id){
            if(isset($_POST['Tender']) && isset($_POST['TenderProduct']))
            {
                $dataTender = $_POST['Tender'];
                $modelTender[0]->type = $dataTender['type'];
                $modelTender[0]->value = $dataTender['value'];
                $modelTender[0]->delivery_data = $dataTender['delivery_data'];
                $modelTender[0]->delivery_site = $dataTender['delivery_site'];
                $modelTender[0]->comments = $dataTender['comments'];
                $modelTender[0]->verified = TenderSignup::VERIFIED_OFF;
                if ($dataTender['status']){
                    $modelTender[0]->status = TenderSignup::STATUS_PUBLISHED;
                }else{
                    $modelTender[0]->status = TenderSignup::STATUS_NEW;
                }
                if ($modelTender[0]->save()){
                    $dataTenderProduct = $_POST['TenderProduct'];
                    for($z = 0; $z<= count($_POST['TenderProduct']) - 1 ; $z ++){
                        $modelTenderProduct[$z]->product_id = $dataTenderProduct[$z]['product_id'];
                        $modelTenderProduct[$z]->budget = $dataTenderProduct[$z]['budget'];
                        $modelTenderProduct[$z]->save();
                    }
                    return $this->redirect('index');
                }else{
                    return null;
                }
            }
            return $this->render('update',[
                'modelTender' => $modelTender,
                'modelTenderProduct' => $modelTenderProduct
            ]);
        }else if(Yii::$app->user->identity->superadmin){
            if(isset($_POST['Tender']) && isset($_POST['TenderProduct']))
            {
                $dataTender = $_POST['Tender'];
                $modelTender[0]->type = $dataTender['type'];
                $modelTender[0]->value = $dataTender['value'];
                $modelTender[0]->delivery_data = $dataTender['delivery_data'];
                $modelTender[0]->delivery_site = $dataTender['delivery_site'];
                $modelTender[0]->comments = $dataTender['comments'];
                $modelTender[0]->verified = TenderSignup::VERIFIED_OFF;
                if ($dataTender['status']){
                    $modelTender[0]->status = TenderSignup::STATUS_PUBLISHED;
                }else{
                    $modelTender[0]->status = TenderSignup::STATUS_NEW;
                }
                if ($modelTender[0]->save()){
                    $dataTenderProduct = $_POST['TenderProduct'];
                    for($z = 0; $z<= count($_POST['TenderProduct']) - 1 ; $z ++){
                        $modelTenderProduct[$z]->product_id = $dataTenderProduct[$z]['product_id'];
                        $modelTenderProduct[$z]->budget = $dataTenderProduct[$z]['budget'];
                        $modelTenderProduct[$z]->save();
                    }
                    return $this->redirect('index');
                }else{
                    return null;
                }
            }
            return $this->render('update',[
                'modelTender' => $modelTender,
                'modelTenderProduct' => $modelTenderProduct
            ]);
        }else{
            return $this->redirect('index');
        }




    }

    public function actionClose($id){
        $modelTender = new Tender();
        $modelTender = $modelTender::find()->where(['id' => $id])->all();

        if ($modelTender[0]['company_id'] === Yii::$app->user->identity->company_id){

            $modelTender[0]['status'] = TenderSignup::STATUS_CANCELLED;
            if($modelTender[0]->save()){
                return $this->redirect('index');
            }
        }else if (Yii::$app->user->identity->superadmin){

            $modelTender[0]['status'] = TenderSignup::STATUS_CANCELLED;
            if($modelTender[0]->save()){
                return $this->redirect('index');
            }
        }
    }

    public function actionDelete($id){
        $modelTender = new Tender();
        $modelTender = $modelTender::find()->where(['id' => $id])->all();

        if(Yii::$app->user->identity->superadmin){
            $modelTender[0]['status'] = TenderSignup::STATUS_DELETED;
            if($modelTender[0]->save()){
                return $this->redirect('index');
            }
        }else{
            return $this->redirect('index');
        }
    }

    public function actionPush($id){
        $modelTender = new Tender();
        $modelTender = $modelTender::find()->where(['id' => $id])->all();

        $modelTender[0]['status'] = TenderSignup::STATUS_PUBLISHED;
        if($modelTender[0]->save()){
            return $this->redirect('index');
        }
    }


}