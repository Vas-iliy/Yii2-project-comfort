<?php

namespace core\forms;

use core\entities\Project;
use core\entities\State;
use yii\base\Model;
use yii\web\UploadedFile;

class StateUpdateFrom extends Model
{
    public $title;
    public $title_recommendation;
    public $content;
    public $category;
    public $status;
    public $image;

    private $_state;

    public function __construct(State $state, $config = [])
    {
        $this->title = $state->title;
        $this->title_recommendation = $state->title_recommendation;
        $this->content = $state->content;
        $this->category = $state->category->id;
        $this->status = $state->status;
        $this->_state = $state;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'content', 'category'], 'required'],
            [['title', 'content', 'title_recommendation'], 'string'],
            [['status', 'category'], 'integer'],
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