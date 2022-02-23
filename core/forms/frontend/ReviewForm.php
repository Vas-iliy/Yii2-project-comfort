<?php

namespace core\forms\frontend;

use yii\base\Model;

class ReviewForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $subject;

    public function rules()
    {
        return [
            [['name', 'phone', 'email' ,'subject'], 'required' , 'message' => 'Поле не заполнено'],
            [['phone'], 'string', 'min' => 18, 'max' => 18,  'tooShort' => 'Введите номер полностью',  'tooLong' => 'Введите номер полностью'],
            [['name'], 'string', 'min' => 2, 'tooShort' => 'Минимум 2 символа'],
            ['email', 'email', 'message' => 'Введите правильный email']
        ];
    }

}