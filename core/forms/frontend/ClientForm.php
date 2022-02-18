<?php

namespace core\forms\frontend;

use core\entities\Client;
use yii\base\Model;

class ClientForm extends Model
{
    public $name;
    public $phone;
    public $material;
    public $status;

    public function __construct(Client $client = null, $config = [])
    {
        if ($client) {
            $this->status = $client->status;
            $this->phone = $client->phone;
            $this->name = $client->name;
            $this->material = $client->material;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'phone'], 'required' , 'message' => 'Поле не заполнено'],
            [['phone'], 'string', 'min' => 18, 'max' => 18,  'tooShort' => 'Введите номер полностью',  'tooLong' => 'Введите номер полностью'],
            [['name'], 'string', 'min' => 2, 'tooShort' => 'Минимум 2 символа'],
            ['material', 'string'],
            ['status', 'boolean'],
        ];
    }

}