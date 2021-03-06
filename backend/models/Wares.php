<?php

namespace backend\models;

use app\models\Brand;
use Yii;

/**
 * This is the model class for table "wares".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $inputime
 */
class Wares extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imgFile;
    public static $statusText=['0'=>'隐藏','1'=>'显示'];
    public static $statusSale=['1'=>'上架','0'=>'下架'];
    public static function tableName()
    {
        return 'wares';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'goods_id', 'brand_id', 'market_price', 'shop_price', 'stock', 'is_on_sale', 'status', 'sort'], 'required'],
            [['goods_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort'], 'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['name'], 'string', 'max' => 255],
            //[['sn'], 'string', 'max' => 15],
            [['logo'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'sn' => '货号',
            'logo' => '商品logo',
            'goods_id' => '商品分类',
            'brand_id' => '品牌',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'is_on_sale' => '是否上架',
            'status' => '状态',
            'sort' => '排序',
            'inputime' => '录入时间',
        ];
    }
public function getGoods(){
        return $this->hasOne(Goods::className(),['id'=>'goods_id']);
}
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
}
