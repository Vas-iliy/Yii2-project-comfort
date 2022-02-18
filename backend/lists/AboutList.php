<?php

namespace backend\lists;

use core\entities\About;
use core\forms\AboutForm;
use core\helpers\StatusHelper;

class AboutList
{
    public static function serializeListItem(About $about)
    {
        return [
            'id' => $about->id,
            'title' => $about->title,
            'description' => $about->description,
            'status' => StatusHelper::status($about->status, new About())
        ];
    }

    public static function formAbout(AboutForm $form)
    {
        return [
            'title' => $form->title,
            'description' => $form->description,
            'status' => $form->status
        ];
    }
}