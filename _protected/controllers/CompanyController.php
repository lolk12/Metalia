<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 23.06.2017
 * Time: 13:39
 */

namespace app\controllers;



use app\models\Company;
use Yii;
use yii\web\Controller;
use app\models\CompanySignup;
use app\models\Card\CompanyUnitSignup;
use app\models\Card\CompanyRevenueSignup;

class CompanyController extends Controller
{
    public $enableCsrfValidation = false;
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
        $modelCompany = new CompanySignup();
        $modelCompanyUnit = new CompanyUnitSignup();
        $modelCompanyRevenue = new CompanyRevenueSignup();

        $year = getdate()['year'];
        $id = Yii::$app->user->identity->company_id;
        if(isset($_POST['CompanySignup']) && isset($_POST['CompanyUnitSignup']) && isset($_POST['CompanyRevenueSignup']))
        {
            $modelCompany->attributes = Yii::$app->request->post('CompanySignup');
            if($modelCompany->signupProfile()){
                $i = 3;
                foreach ($_POST['CompanyRevenueSignup']['revenue'] as $key){
                    $modelCompanyRevenue->revenue = $key;
                    $modelCompanyRevenue->year = $year - $i;
                    if ($modelCompanyRevenue->signup($id)){
                        $i = $i - 1;
                    }
                }
                $modelCompanyUnit->attributes = $_POST['CompanyUnitSignup']['0'];
                $modelCompanyUnit->signup($id,1);
                if($_POST['CompanyUnitSignup'][1]){
                    for($z = 1; $z<= count($_POST['CompanyUnitSignup']) - 1 ; $z ++){
                        $modelCompanyUnit->name = $_POST['CompanyUnitSignup'][$z]['name'];
                        $modelCompanyUnit->address = $_POST['CompanyUnitSignup'][$z]['address'];
                        $modelCompanyUnit->telephone = $_POST['CompanyUnitSignup'][$z]['telephone'];
                        $modelCompanyUnit->description = $_POST['CompanyUnitSignup'][$z]['description'];
                        $modelCompanyUnit->signup($id,0);
                    }
                    return $this->redirect('/admin/');
                }else{
                    return $this->redirect('/admin/');
                }




            }
        }

        return $this->render('index',[
            'modelCompany' => $modelCompany,
            'modelCompanyRevenue' => $modelCompanyRevenue,
            'modelCompanyUnit' => $modelCompanyUnit,
            'year' => $year,
            ]);
    }
}