<?php

namespace core\helpers;

class MaterialHelper
{
    public function material($materials)
    {
        $return = [];
        if (!empty($materials)){
            foreach ($materials as $material) {
                $return[$material['material']] = $material['material'];
            }
        }
        return $return;
    }
}