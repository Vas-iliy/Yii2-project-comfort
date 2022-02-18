<?php

namespace core\forms;

use core\entities\Service;
use core\entities\ServicePoint;
use yii\base\Model;
use yii\web\UploadedFile;

class ServicePointFrom extends Model
{
    public $title;
    public $description;
    public $textItems;
    public $service;
    public $status;

    private $_point;

    public function __construct(ServicePoint $point = null, $config = [])
    {
        if ($point) {
            $this->title = $point->title;
            $this->description = $point->description;
            $this->textItems = implode(PHP_EOL, $point->items);
            $this->service = $point->service;
            $this->status = $point->status;
            $this->_point = $point;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'description', 'textItems'], 'string'],
            [['status', 'service'], 'integer'],
        ];
    }

    public function getItems()
    {
        return preg_split('#\n+#i', $this->textItems);
    }
}