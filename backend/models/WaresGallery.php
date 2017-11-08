<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2017/11/8
 * Time: 18:49
 */

namespace backend\models;


class WaresGallery extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'goods_gallery';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['path'], 'required'],
            [['path'], 'string', 'max' => 255],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品id',
            'path' => '图片地址',
        ];
    }
}