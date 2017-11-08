<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wares_intro".
 *
 * @property string $wares_id
 * @property string $content
 */
class WaresIntro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wares_intro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','name'], 'required'],
            [['content'], 'string'],
            [['logo_one'], 'string', 'max' => 200],
            [['logo_two'], 'string', 'max' => 200],
            [['logo_three'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wares_id' => '商品名称',
            'content' => '内容',
        ];
    }
}
