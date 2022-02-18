<?php

namespace core\forms;

use core\entities\Filter;
use yii\base\Model;
use yii\web\UploadedFile;

class FilterForm extends Model
{
    public $filter;
    public $top;
    public $status;
    public $image;

    public function __construct(Filter $filter = null,$config = [])
    {
        if ($filter) {
            $this->filter = $filter->filter;
            $this->top = $filter->top;
            $this->status = $filter->status;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['filter'], 'required'],
            [['filter'], 'string'],
            [['status'], 'integer'],
            ['top', 'boolean'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}