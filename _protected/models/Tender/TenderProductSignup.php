<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 10.07.2017
 * Time: 0:21
 */

namespace app\models\Tender;

use yii\base\Model;
use Yii;


class TenderProductSignup extends Model
{

    public $tender_id;
    public $company_id;
    public $product_id;
    public $budget;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'product_id', 'budget'], 'required'],
            [['company_id', 'product_id', 'budget', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'product_id' => Yii::t('app', 'Товары / Услуги'),
            'budget' => Yii::t('app', 'Количество'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function signup($id){
        $tenderProduct = new TenderProduct();
        $tenderProduct->tender_id = $id;
        $tenderProduct->company_id = Yii::$app->user->identity->company_id;
        $tenderProduct->product_id = $this->product_id;
        $tenderProduct->budget = $this->budget;

        if($tenderProduct->save()){
            return $tenderProduct;
        }else{
            return null;
        }
    }

}