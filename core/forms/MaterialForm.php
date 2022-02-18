<?php

namespace core\forms;

use core\entities\Material;
use yii\base\Model;

class MaterialForm extends Model
{
    public $material;
    public $status;

    private $_contact;

    public function __construct(Material $material = null, $config = [])
    {
        if ($material) {
            $this->material = $material->material;
            $this->status = $material->status;
            $this->_contact = $material;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['material'], 'required' , 'message' => 'Поле не заполнено'],
            [['material'], 'string'],
            ['status', 'number'],
        ];
    }
}