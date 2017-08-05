<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 23.06.2017
 * Time: 16:12
 */

namespace app\models\Card;

use yii;
use yii\base\Model;

class CompanyUnitSignup extends Model
{
    public $name;
    public $address;
    public $telephone;
    public $description;

    public function rules()
    {
        return [
            [['name','address'], 'string'],
            ['telephone', 'integer'],
            [['name','address','telephone'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return[
            'name' => Yii::t('app','Название подразделения'),
            'address' => Yii::t('app','Адрес'),
            'telephone' => Yii::t('app','Телефон'),
        ];
    }

    public function signup($id, $actual){
        $company = new CompanyUnit();
        $company->company_id = $id;
        $company->name = $this->name;
        $company->address = $this->address;
        $company->telephone = $this->telephone;
        $company->is_main = $actual;
        $company->description = $this->description;

        if ($company->save()){
            return $company;
        }else{
            return null;
        }
    }
}