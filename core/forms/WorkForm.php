<?php

namespace core\forms;

use core\entities\Work;
use yii\base\Model;
use yii\web\UploadedFile;

class WorkForm extends Model
{
    public $description;
    public $images;

    private $_work;

    public function __construct(Work $work, $config = [])
    {
        $this->description = $work->description;
        $this->_work = $work;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['description'], 'required' , 'message' => 'Поле не заполнено'],
            [['description'], 'string'],
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