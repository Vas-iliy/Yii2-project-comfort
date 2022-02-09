<?php

namespace core\repositories\frontend;

use core\entities\About;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class AboutRepository
{
    public function getStates()
    {
        if (!$about = About::find()->all()) {
            throw new NotFoundHttpException('No contacts.');
        }
        $about = TitleHelper::editTitle($about);
        return $about;
    }
}