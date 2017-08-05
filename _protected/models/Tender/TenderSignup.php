<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 09.07.2017
 * Time: 23:48
 */

namespace app\models\Tender;

use yii\base\Model;
use Yii;

class TenderSignup extends Model
{
    public $id;
    public $company_id;
    public $type;
    public $value;
    public $delivery_data;
    public $delivery_site;
    public $comments;
    public $verified;
    public $status;

    const STATUS_NEW = 1; /// New tender
    const STATUS_PUBLISHED = 2; // Published tender
    const STATUS_FINISHED  = 3; // Finished tender
    const STATUS_CANCELLED = 4; // Cancelled tender
    const STATUS_DELETED = 0; // Deleted tender

    const VERIFIED_ON = 1; // Verified tender
    const VERIFIED_OFF = 0; // Verified tender

    const TYPE_REQUEST = 0; // request tender
    const TYPE_SUPPLY = 1; // supply tender
    const TYPE_SEMI_FINISHED = 2; // Manufacturing of semi-finished products
    const TYPE_FINISHED = 3; // Finished products
    const TYPE_SERVICE = 4; // Services tender

    public function rules()
    {
        return [
            [['company_id', 'type', 'delivery_data', 'delivery_site', 'comments', 'status'], 'required'],
            [['company_id', 'type', 'value', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['delivery_data'], 'safe'],
            [['delivery_site', 'comments'], 'string'],
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
            'type' => Yii::t('app', 'Тип тендра'),
            'value' => Yii::t('app', 'Стоимость'),
            'delivery_data' => Yii::t('app', 'Сроки поставки'),
            'delivery_site' => Yii::t('app', 'Место поставки'),
            'comments' => Yii::t('app', 'Коментарии'),
            'status' => Yii::t('app', 'Статус'),

        ];
    }

    public function signup(){
        $tender = new Tender();
        $tender->company_id = Yii::$app->user->identity->company_id;
        $tender->type = $this->type;
        $tender->value = $this->value;
        $tender->delivery_data = $this->delivery_data;
        $tender->delivery_site = $this->delivery_site;
        $tender->comments = $this->comments;
        $tender->verified = TenderSignup::VERIFIED_OFF;
        if($this->status){
            $tender->status = TenderSignup::STATUS_PUBLISHED;
        }else{
            $tender->status = TenderSignup::STATUS_NEW;
        }
        if ($tender->save()){
            $this->id = $tender->id;
            return $tender;
        }else{
            return null;
        }
    }

    public function getId(){
        return $this->id;
    }
}