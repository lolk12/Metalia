<?php

namespace app\models\Tender;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tender".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $type
 * @property integer $value
 * @property string $delivery_data
 * @property string $delivery_site
 * @property string $comments
 * @property integer $status
 * @property integer $verified-tender
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Tender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tender';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),

        ];
    }

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
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Последнее изменение')

        ];
    }
}
