<?php

namespace core\forms;

use core\entities\StateCategory;
use yii\base\Model;

class StateCategoryFrom extends Model
{
    public $title;
    public $status;

    private $_contact;

    public function __construct(StateCategory $contact = null, $config = [])
    {
        if ($contact) {
            $this->title = $contact->title;
            $this->status = $contact->status;
            $this->_contact = $contact;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title'], 'required' , 'message' => 'Поле не заполнено'],
            [['title'], 'string'],
            ['status', 'number'],
        ];
    }
}