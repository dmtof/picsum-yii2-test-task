<?php

namespace app\models;

use yii\db\ActiveRecord;

class Image extends ActiveRecord
{
    public static function tableName()
    {
        return 'image';
    }

    public function rules()
    {
        return [
            [['image_id', 'decision'], 'required'],
            [['image_id'], 'integer'],
            [['decision'], 'string', 'max' => 255],
        ];
    }

}