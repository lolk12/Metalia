<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 11.05.2017
 * Time: 20:20
 */

namespace app\models;
use Yii;
use kartik\tree\models\Tree;

class TreeFolder extends Tree
{
    public static function tableName()
    {
        return 'tree';
    }
    /**
     * Override isDisabled method if you need as shown in the
     * example below. You can override similarly other methods
     * like isActive, isMovable etc.
     */
    /*public function isDisabled()
    {
        if (Yii::$app->user->username !== 'admin') {
            return true;
        }
        return parent::isDisabled();
    }*/
}