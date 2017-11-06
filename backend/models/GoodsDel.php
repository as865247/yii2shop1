<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2017/11/6
 * Time: 16:10
 */

namespace app\models;


use yii\db\ActiveRecord;

class GoodsDel extends ActiveRecord
{

    public static function tableName()
    {
        return 'goods';
    }
}