<?php

namespace backend\lists;

use core\entities\Advantage;
use core\forms\AdvantageFrom;
use core\helpers\StatusHelper;

class AdvantageList
{
    public static function serializeListItem(Advantage $advantage)
    {
        return [
            'id' => $advantage->id,
            'title' => $advantage->title,
            'description' => $advantage->description,
            'status' => StatusHelper::status($advantage->status, new Advantage())
        ];
    }

    public static function formContact(AdvantageFrom $form)
    {
        return [
            'title' => $form->title,
            'description' => $form->description,
            'status' => $form->status
        ];
    }
}