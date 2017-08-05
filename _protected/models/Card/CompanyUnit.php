<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 23.06.2017
 * Time: 16:08
 */

namespace app\models\Card;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property integer $id
 * @property integer $company_id
 * @property string $name
 * @property string $address
 * @property integer $telephone
 * @property boolean $is_main
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $created_by
 * @property string $updated_by
**/

class CompanyUnit extends ActiveRecord
{
    public static function tableName(){
        return 'company_unit';
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

}