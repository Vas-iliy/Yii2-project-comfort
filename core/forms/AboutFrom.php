<?php

namespace core\forms;

use core\entities\Contact;
use yii\base\Model;

class AboutFrom extends Model
{
    public $title;
    public $description;
    public $status;

    private $_contact;

    public function __construct(Contact $contact = null, $config = [])
    {
        if ($contact) {
            $this->title = $contact->title;
            $this->description = $contact->description;
            $this->status = $contact->status;
            $this->_contact = $contact;
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