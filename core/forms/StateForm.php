<?php

namespace core\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class StateForm extends Model
{
    public $title;
    public $title_recommendation;
    public $content;
    public $category;
    public $status;
    public $image;

    public function rules()
    {
        return [
            [['title', 'content', 'category'], 'required'],
            [['title', 'content', 'title_recommendation'], 'string'],
            [['status', 'category'], 'integer'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}