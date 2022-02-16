<?php

namespace core\forms;

use core\entities\Advantage;
use yii\base\Model;

class AdvantageFrom extends Model
{
    public $title;
    public $description;
    public $status;

    private $_advantage;

    public function __construct(Advantage $advantage = null, $config = [])
    {
        if ($advantage) {
            $this->title = $advantage->title;
            $this->description = $advantage->description;
            $this->status = $advantage->status;
            $this->_advantage = $advantage;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'description'], 'string'],
            ['status', 'boolean'],
        ];
    }
}