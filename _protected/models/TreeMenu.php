<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 19.07.2017
 * Time: 14:10
 */

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * User model
 *
 * @property integer $id
 * @property integer $parent
 * @property string $name
 * @property integer $status
 */

class TreeMenu extends ActiveRecord
{
    public static function tableName()
    {
        return 'tree_menu';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),

        ];
    }

    const STATUS_NEW = 1; /// New tender
    const STATUS_DELETED = 0; // Deleted tender
}