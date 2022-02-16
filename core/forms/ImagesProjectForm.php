<?php

namespace core\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class ImagesProjectForm extends Model
{
    public $images;

    public function rules()
    {
        return [
            ['images', 'each', 'rule' => ['image']],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->images = UploadedFile::getInstances($this, 'images');
            return true;
        }
        return false;
    }
}