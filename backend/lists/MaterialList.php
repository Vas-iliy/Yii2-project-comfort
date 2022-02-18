<?php

namespace backend\lists;

use core\entities\Contact;
use core\entities\Material;
use core\forms\ContactForm;
use core\forms\MaterialForm;
use core\helpers\StatusHelper;

class MaterialList
{
    public static function serializeListItem(Material $material)
    {
        return [
            'id' => $material->id,
            'material' => $material->material,
            'status' => StatusHelper::status($material->status, new Material())
        ];
    }

    public static function formMaterial(MaterialForm $form)
    {
        return [
            'material' => $form->material,
            'status' => $form->status
        ];
    }
}