<?php

namespace core\repositories;

use core\entities\Page;

class PageRepository
{
    public function getAlias($alias)
    {
        $page = \Yii::$app->cache->get($alias);
        if (empty($page)) {
            $page = Page::find()->andWhere(['alias' => $alias])->limit(1)->one();
            \Yii::$app->cache->set($alias, $page, 3600 * 24 *30);
        }
        return $page;
    }

    public function getPages()
    {
        $pages = \Yii::$app->cache->get('menu');
        if (empty($pages)) {
            $pages = Page::find()->where(['main_page' => 1])->all();
            \Yii::$app->cache->set('menu', $pages, 3600 * 24 *30);
        }
        return $pages;
    }
}