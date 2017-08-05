<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 25.06.2017
 * Time: 20:55
 */

namespace app\models\Card;

use yii;
use yii\base\Model;

class CompanyRevenueSignup extends Model
{
    public $company_id;
    public $revenue;
    public $year;

    public function rules()
    {
        return [
            [['company_id','revenue','year'], 'integer'],
            [['company_id','revenue','year'], 'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'revenue' => Yii::t('app','Доход за этот год'),
            'year' => Yii::t('app','Год'),
        ];
    }

    public function signup($id){
        $companyRevenue = new CompanyRevenue();

        $companyRevenue->year = $this->year;
        $companyRevenue->company_id = $id;
        $companyRevenue->revenue = $this->revenue;

        if ($companyRevenue->save()){
            return $companyRevenue;
        }else{
            return null;
        }
    }
}