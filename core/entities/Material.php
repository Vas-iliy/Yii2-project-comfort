<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Material extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'materials';
    }

    public static function create($title,  $status)
    {
        $contact = new static();
        $contact->material = $title;
        $contact->status = $status ? $status : Material::STATUS_INACTIVE;
        return $contact;
    }

    public function edit($title,  $status)
    {
        $this->material = $title;
        $this->status = $status ? $status : Material::STATUS_INACTIVE;
    }
}