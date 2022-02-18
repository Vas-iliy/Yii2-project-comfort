<?php

namespace core\services;

use core\entities\Material;
use core\forms\MaterialForm;
use core\repositories\MaterialRepository;

class MaterialService
{
    private $materials;

    public function __construct(MaterialRepository $materials)
    {
        $this->materials = $materials;
    }

    public function create(MaterialForm $form)
    {
        $material = Material::create(
            $form->material,
            $form->status ?? null
        );
        $this->materials->save($material);
        return $material;
    }

    public function edit($id, MaterialForm $form)
    {
        $material = $this->materials->get($id);
        $material->edit(
            $form->material,
            $form->status ?? null
        );
        $this->materials->save($material);
        return $material;
    }

    public function remove($id)
    {
        $material = $this->materials->get($id);
        $this->materials->remove($material);
    }
}