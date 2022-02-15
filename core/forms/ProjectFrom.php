<?php

namespace core\forms;

use core\entities\Project;
use yii\base\Model;
use yii\web\UploadedFile;

class ProjectFrom extends Model
{
    public $title;
    public $square;
    public $count_floors;
    public $description;
    public $prise;
    public $popular;
    public $material;
    public $filter;
    public $images;

    private $_project;

    public function __construct(Project $project = null, $config = [])
    {
        if ($project) {
            $this->title = $project->title;
            $this->square = $project->square;
            $this->count_floors = $project->count_floors;
            $this->description = $project->description;
            $this->prise = $project->prise;
            $this->popular = $project->popular;
            $this->material = $project->material;
            $this->filter = $project->filter;
            $this->_project = $project;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'square', 'count_floors', 'description', 'prise', 'popular', 'material', 'filter', 'images'], 'required' , 'message' => 'Поле не заполнено'],
            [['title', 'description'], 'string'],
            [['count_floors', 'prise', 'material', 'filter'], 'integer'],
            [['square'], 'number'],
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