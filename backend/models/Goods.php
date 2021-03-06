<?php

namespace backend\models;

use backend\components\MenuQuery;
use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property string $intro
 * @property integer $parent_id
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'parent_id'], 'required'],
            [[ 'parent_id'], 'integer'],
            [['name', 'intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lft' => '左值',
            'rgt' => '右值',
            'depth' => '深度',
            'name' => '分类名称',
            'intro' => '简介',
            'parent_id' => '父类Id',
        ];
    }
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
               //  'leftAttribute' => 'lft',
                //'rightAttribute' => 'rgt',
                //'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());

    }

    public function getNameText(){
        return str_repeat("-",4*$this->depth).$this->name;
    }

}
