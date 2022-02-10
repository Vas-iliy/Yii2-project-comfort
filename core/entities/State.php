<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

class State extends ActiveRecord
{
    public static function tableName()
    {
        return 'states';
    }

    public function getCategory()
    {
        return $this->hasOne(StateCategory::class, ['id' => 'category_id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/states/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/states/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/states/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/states/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }
}