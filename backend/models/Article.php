<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $article_categroy_id
 * @property integer $inputime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public  static $statusText=['-1'=>'删除','0'=>'隐藏','1'=>'显示'];
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intro'], 'string'],
            [['status', 'sort', 'article_categroy_id', 'inputime'], 'integer'],
            [['content'],'required'],
            [['name'], 'string', 'max' => 200],
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
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'article_categroy_id' => '文章分类',
            'content'=>'文章内容',
            'inputime' => '录入时间',
        ];
    }
public function getCate(){
        return $this->hasOne(Category::className(),['id'=>'article_categroy_id']);
}
}
