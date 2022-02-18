<?php

namespace core\forms;

use core\entities\StateCategory;
use yii\base\Model;

class StateCategoryFrom extends Model
{
    public $title;
    public $status;

    private $_category;

    public function __construct(StateCategory $category = null, $config = [])
    {
        if ($category) {
            $this->title = $category->title;
            $this->status = $category->status;
            $this->_category = $category;
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