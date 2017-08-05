<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 27.06.2017
 * Time: 14:57
 */

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $target
 * @property string $vatin
 * @property string $company_name
 * @property string $phone_number
 * @property string $email
 * @property string $web_site
 * @property integer $staff
 * @property integer $initial_capital
 * @property integer $assets
 * @property string $property
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $created_at
 */

class Company extends ActiveRecord
{
    const VALIDATE_ON = 1;
    const VALIDATE_OFF = 0;

    public static function tableName()
    {
        return 'company';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),

        ];
    }
    public static function findIdentity($id){

    }
    public static function findIdentityByAccessToken($token, $type = null){

    }
    public function getId(){

    }
    public function getAuthKey(){

    }
    public function validateAuthKey($authKey){

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
            'updated_at' => Yii::t('app','Последнии изменения'),
        ];
    }
}