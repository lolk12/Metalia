<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 10.07.2017
 * Time: 0:53
 */

namespace app\models\Tender;

use yii\base\Model;
use Yii;

class TenderFileSignup extends Model
{

    public $tender_id;
    public $company_id;
    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['file'], 'string'],
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
            'file' => Yii::t('app', 'File'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}