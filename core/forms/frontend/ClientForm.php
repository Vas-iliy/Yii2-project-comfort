<?php

namespace core\forms\frontend;

use yii\base\Model;

class ClientForm extends Model
{
    public $name;
    public $phone;
    public $material;

    public function rules()
    {
        return [
            [['name', 'phone'], 'required' , 'message' => 'Поле не заполнено'],
            [['phone'], 'string', 'min' => 18, 'max' => 18,  'tooShort' => 'Введите номер полностью',  'tooLong' => 'Введите номер полностью'],
            [['name'], 'string', 'min' => 2, 'tooShort' => 'Минимум 2 символа'],
            ['material', 'safe'],
        ];
    }

}