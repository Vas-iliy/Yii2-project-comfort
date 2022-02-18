<?php

namespace core\forms;

use core\entities\About;
use yii\base\Model;

class AboutFrom extends Model
{
    public $title;
    public $description;
    public $status;

    private $_about;

    public function __construct(About $about= null, $config = [])
    {
        if ($about) {
            $this->title = $about->title;
            $this->description = $about->description;
            $this->status = $about->status;
            $this->_about= $about;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'description'], 'string'],
            ['status', 'number'],
        ];
    }
}