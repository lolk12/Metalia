<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 15.07.2017
 * Time: 17:20
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\Company;
use app\models\Card\CompanyUnit;
use app\models\Card\CompanyRevenue;
use yii\data\ActiveDataProvider;
use Yii;

class VerifiedCompanyController extends Controller
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
        $modelCompany = new Company();
        $queryCompany = $modelCompany::find()
            ->where(['validate' => 0]);
        $modelCompany = new ActiveDataProvider([
            'query' => $queryCompany,
        ]);

        return $this->render('index',[
            'modelCompany' => $modelCompany,
        ]);
    }

    public function actionView($id){
        $modelCompany = new Company();
        $modelCompanyRevenue = new CompanyRevenue();
        $modelCompanyUnit = new CompanyUnit();
        $modelCompany = $modelCompany::find()->where(['id' => $id])->all();
        $queryCompanyRevenue = $modelCompanyRevenue::find()
            ->where(['company_id' => $id]);
        $modelCompanyRevenue = new ActiveDataProvider([
            'query' => $queryCompanyRevenue,
        ]);
        $queryCompanyUnit = $modelCompanyUnit::find()->where(['company_id' => $id]);

        $modelCompanyUnit = new ActiveDataProvider([
           'query' => $queryCompanyUnit
        ]);

        return $this->render('view',[
            'modelCompany' => $modelCompany,
            'modelCompanyRevenue' => $modelCompanyRevenue,
            'modelCompanyUnit' => $modelCompanyUnit,
            'id' => $id,
        ]);
    }

    public function actionVerified($id){
        $modelCompany = new Company();
        $modelCompany = $modelCompany::find()->where(['id' => $id])->all();
        $modelCompany[0]['validate'] = Company::VALIDATE_ON;
        if($modelCompany[0]->save()){
            return $this->redirect('/verified-company/index');
        }
    }



}