<?php

namespace core\forms;

use core\entities\Service;
use yii\base\Model;
use yii\web\UploadedFile;

class ServiceForm extends Model
{
    public $title;
    public $description;
    public $textItems;
    public $status;
    public $images;

    private $_service;

    public function __construct(Service $service = null, $config = [])
    {
        if ($service) {
            $this->title = $service->title;
            $this->description = $service->description;
            $this->textItems = implode(PHP_EOL, $service->items);
            $this->status = $service->status;
            $this->_service = $service;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'description', 'textItems'], 'string'],
            [['status'], 'number'],
            ['images', 'each', 'rule' => ['image']],
        ];
    }

    public function getItems()
    {
        return preg_split('#\n+#i', $this->textItems);
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