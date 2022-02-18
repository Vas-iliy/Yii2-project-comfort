<?php

namespace core\forms;

use core\entities\Project;
use core\entities\State;
use yii\base\Model;
use yii\web\UploadedFile;

class StateFrom extends Model
{
    public $title;
    public $title_recommendation;
    public $count_floors;
    public $content;
    public $category;
    public $status;
    public $image;

    private $_state;

    public function __construct(State $state = null, $config = [])
    {
        if ($state) {
            $this->title = $state->title;
            $this->title_recommendation = $state->title_recommendation;
            $this->content = $state->content;
            $this->category_id = $state->category->id;
            $this->status = $state->status;
            $this->_state = $state;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'content', 'category_id'], 'required'],
            [['title', 'content', 'title_recommendation'], 'string'],
            [['status', 'category_id'], 'integer'],
            ['image', 'each', 'rule' => ['image']],
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