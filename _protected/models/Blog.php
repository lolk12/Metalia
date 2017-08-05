<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_text
 * @property string $full_text
 * @property integer $active
 * @property string $created_by
 * @property string $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Blog extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'short_text', 'active'], 'required'],
            [['full_text'], 'string'],
            [['active', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['short_text', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Заголовок'),
            'short_text' => Yii::t('app', 'Короткий текст'),
            'full_text' => Yii::t('app', 'Полный текст'),
            'active' => Yii::t('app', 'Статус'),
            'created_by' => Yii::t('app', 'Создано'),
            'updated_by' => Yii::t('app', 'Редактировано'),
            'created_at' => Yii::t('app', 'Создал'),
            'updated_at' => Yii::t('app', 'Редактировал'),
        ];
    }

    
    

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
            BlameableBehavior::className(),
        ];
    }

}
