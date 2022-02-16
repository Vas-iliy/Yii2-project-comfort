<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'contacts';
    }

    public static function create($title, $content, $status)
    {
        $contact = new static();
        $contact->title = $title;
        $contact->content = $content;
        $contact->status = $status ? $status : Contact::STATUS_INACTIVE;
        return $contact;
    }

    public function edit($title, $content, $status)
    {
        $this->title = $title;
        $this->content = $content;
        $this->status = $status ? $status : Contact::STATUS_INACTIVE;
    }
}