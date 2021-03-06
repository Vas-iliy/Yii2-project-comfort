<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

class Filter extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'filters';
    }

    public static function create($title, $status, $top = null, $file = null)
    {
        $filter = new static();
        $filter->filter = $title;
        $filter->top = $top;
        $filter->status = $status ? $status : Filter::STATUS_INACTIVE;
        $filter->image = $file;
        return $filter;
    }

    public function edit($filter, $status, $top = null, $file = null)
    {
        $this->filter = $filter;
        $this->top = $top;
        $this->status = $status ? $status : Filter::STATUS_INACTIVE;
        $this->image = $file;
    }

    public function getProjects()
    {
        return $this->hasMany(Project::class, ['filter_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/filters/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/filters/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/filters/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/filters/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }
}