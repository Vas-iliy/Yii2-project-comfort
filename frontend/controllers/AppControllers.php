<?php

namespace frontend\controllers;

use core\repositories\frontend\ContactRepository;
use core\repositories\frontend\PageRepository;
use yii\web\Controller;

class AppControllers extends Controller
{
    public $contacts;
    public $page;

    protected function getContact()
    {
        return (new ContactRepository())->getContacts();
    }

    protected function getPage($alias)
    {
        return (new PageRepository())->getAlias($alias);
    }

    protected function setMeta($title = null, $key = null, $descr = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$key"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$descr"]);
    }
}