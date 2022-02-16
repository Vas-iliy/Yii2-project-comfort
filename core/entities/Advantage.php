<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Advantage extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'advantages';
    }

    public static function create($title, $description, $status)
    {
        $advantage = new static();
        $advantage->title = $title;
        $advantage->description = $description;
        $advantage->status = $status ? $status : Advantage::STATUS_INACTIVE;
        return $advantage;
    }

    public function edit($title, $description, $status)
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status ? $status : Advantage::STATUS_INACTIVE;
    }
}