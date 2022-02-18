<?php

namespace core\forms;

use core\entities\ServicePoint;
use yii\base\Model;

class ServicePointFrom extends Model
{
    public $title;
    public $description;
    public $textItems;
    public $service;

    private $_point;

    public function __construct(ServicePoint $point = null, $config = [])
    {
        if ($point) {
            $this->title = $point->title;
            $this->description = $point->description;
            $this->textItems = implode(PHP_EOL, $point->items);
            $this->service = $point->service;
            $this->_point = $point;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'description', 'service'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'description', 'textItems'], 'string'],
            [['service'], 'integer'],
        ];
    }

    public function getItems()
    {
        return preg_split('#\n+#i', $this->textItems);
    }
}