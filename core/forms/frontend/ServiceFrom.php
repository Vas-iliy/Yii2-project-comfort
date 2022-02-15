<?php

namespace core\forms\frontend;

use core\entities\Service;
use yii\base\Model;

class ServiceFrom extends Model
{
    public $title;
    public $description;
    public $textItems;

    private $_service;

    public function __construct(Service $service = null, $config = [])
    {
        if ($service) {
            $this->title = $service->title;
            $this->description = $service->description;
            $this->textItems = implode(PHP_EOL, $service->items);
        }
        parent::__construct($config);
    }

    public function getItems()
    {
        return preg_split('#\s+#i', $this->textItems);
    }

}