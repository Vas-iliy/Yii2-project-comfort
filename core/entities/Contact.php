<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
    public static function tableName()
    {
        return 'contacts';
    }

    public static function create($title, $content)
    {
        $project = new static();
        $project->title = $title;
        $project->content = $content;
        return $project;
    }

    public function edit($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }
}