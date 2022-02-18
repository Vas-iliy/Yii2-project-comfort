<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

class State extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'states';
    }

    public static function create($title, $title_recommendation, $content, $category, $status, UploadedFile $file)
    {
        $project = new static();
        $project->title = $title;
        $project->title_recommendation = $title_recommendation;
        $project->content = $content;
        $project->category_id = $category;
        $project->status = $status ? $status : State::STATUS_INACTIVE;
        $project->image = $file;
        return $project;
    }

    public function edit($title, $title_recommendation, $content, $category, $status, UploadedFile $file)
    {
        $this->title = $title;
        $this->title_recommendation = $title_recommendation;
        $this->content = $content;
        $this->category_id = $category;
        $this->status = $status ? $status : State::STATUS_INACTIVE;
        $this->image = $file;
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