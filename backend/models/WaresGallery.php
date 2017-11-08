<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wares_gallery".
 *
 * @property integer $id
 * @property string $wares_id
 * @property string $path
 */
class WaresGallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wares_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'wares_id'], 'integer'],
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
            'wares_id' => 'Wares ID',
            'path' => 'Path',
        ];
    }
}
