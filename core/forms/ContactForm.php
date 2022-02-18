<?php

namespace core\forms;

use core\entities\Contact;
use yii\base\Model;

class ContactForm extends Model
{
    public $title;
    public $content;
    public $status;

    private $_contact;

    public function __construct(Contact $contact = null, $config = [])
    {
        if ($contact) {
            $this->title = $contact->title;
            $this->content = $contact->content;
            $this->status = $contact->status;
            $this->_contact = $contact;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'content'], 'string'],
            ['status', 'number'],
        ];
    }
}