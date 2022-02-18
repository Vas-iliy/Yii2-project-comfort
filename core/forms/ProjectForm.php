<?php

namespace core\forms;

use core\entities\Project;
use yii\base\Model;
use yii\web\UploadedFile;

class ProjectForm extends Model
{
    public $title;
    public $square;
    public $count_floors;
    public $description;
    public $price;
    public $popular;
    public $material;
    public $filter;
    public $status;
    public $images;

    private $_project;

    public function __construct(Project $project = null, $config = [])
    {
        if ($project) {
            $this->title = $project->title;
            $this->square = $project->square;
            $this->count_floors = $project->count_floors;
            $this->description = $project->description;
            $this->price = $project->price;
            $this->popular = $project->popular;
            $this->material = $project->material->id;
            $this->filter = $project->filter->id;
            $this->status = $project->status;
            $this->_project = $project;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'square', 'count_floors', 'description', 'price', 'popular', 'material', 'filter'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'description'], 'string'],
            [['count_floors', 'price', 'material', 'filter'], 'integer'],
            [['square', 'status'], 'number'],
            [['popular'], 'boolean'],
            ['images', 'each', 'rule' => ['image']],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->images = UploadedFile::getInstances($this, 'images');
            return true;
        }
        return false;
    }
}