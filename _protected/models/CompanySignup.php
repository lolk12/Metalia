<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 27.06.2017
 * Time: 15:00
 */

namespace app\models;

use yii;
use yii\base\Model;


class CompanySignup extends Model
{
    public $id;
    public $target;
    public $vatin;
    public $company_name;
    public $phone_number;
    public $email;
    public $web_site;
    public $staff;
    public $initial_capital;
    public $assets;
    public $property;

    public function rules()
    {
        return [
            [['phone_number','vatin'],'trim'],
            [['target','vatin','company_name','phone_number'], 'string'],
            ['vatin','unique', 'targetClass' => '\app\models\Company', 'message' => 'Пользователь с таким ИНН уже зарегистрирован'],
            ['phone_number','unique', 'targetClass' => '\app\models\Company', 'message' => 'Пользователь с таким номером телефона уже зарегистрирован'],
            [['vatin','company_name','phone_number'], 'required'],
            [['property','web_site'], 'string'],
            [['staff','initial_capital','assets'], 'integer'],
           // [['property','web_site','staff','capital','assets'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'target' => Yii::t('app','Цель регистрации'),
            'vatin' => Yii::t('app', 'ИНН/ОГРН'),
            'company_name' => Yii::t('app', 'Название компании'),
            'phone_number' => Yii::t('app', 'Номер телефона компании'),
            'web_site' => Yii::t('app','Сайт компании'),
            'property' => Yii::t('app','Имущество, оборудования'),
            'initial_capital' => Yii::t('app','Уставной капитал'),
            'staff' => Yii::t('app','Штат'),
            'assets' => Yii::t('app','Активы'),
        ];
    }

    public function signup($email){
        $company = new Company();
        $company->target = $this->target;
        $company->vatin = $this->vatin;
        $company->company_name = $this->company_name;
        $company->phone_number = $this->phone_number;
        $company->email = $email;
        $company->validate = Company::VALIDATE_OFF;
        if ($company->save()){
            $this -> id = $company->id;
            return $company;
        }else{
            return null;
        }
    }

    public function signupProfile(){

        $id = Yii::$app->user->identity->company_id;
        $connection = Yii::$app->db;
        $connection->createCommand()->update('company',
            [
                'web_site' => $this->web_site,
                'staff' => $this->staff,
                'initial_capital' => $this->initial_capital,
                'assets' => $this->assets,
                'property' => $this->property
            ],
            "id = $id")->execute();

            return true;
    }

    public function getId(){
        return $this-> id;
    }

}