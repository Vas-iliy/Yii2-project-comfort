<?php

namespace core\forms;

use core\entities\Question;
use yii\base\Model;

class QuestionFrom extends Model
{
    public $title;
    public $description;
    public $status;

    private $_about;

    public function __construct(Question $question= null, $config = [])
    {
        if ($question) {
            $this->title = $question->title;
            $this->description = $question->description;
            $this->status = $question->status;
            $this->_about= $question;
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