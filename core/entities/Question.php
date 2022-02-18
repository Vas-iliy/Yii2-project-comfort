<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Question extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'questions';
    }

    public static function create($title, $description, $status)
    {
        $contact = new static();
        $contact->title = $title;
        $contact->description = $description;
        $contact->status = $status ? $status : Question::STATUS_INACTIVE;
        return $contact;
    }

    public function edit($title, $description, $status)
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status ? $status : Question::STATUS_INACTIVE;
    }
}