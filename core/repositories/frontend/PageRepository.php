<?php

namespace core\repositories\frontend;

use core\entities\Page;
use yii\web\NotFoundHttpException;

class PageRepository
{
    public function getAlias($alias)
    {
        if (!$page = Page::find()->andWhere(['alias' => $alias])->limit(1)->one()) {
            throw new NotFoundHttpException('No contacts.');
        }
        return $page;
    }
}