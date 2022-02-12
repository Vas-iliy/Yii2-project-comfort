<?php

namespace frontend\controllers;

use core\forms\frontend\ClientForm;
use core\helpers\MaterialHelper;
use core\repositories\frontend\ContactRepository;
use core\repositories\frontend\MaterialRepository;
use core\repositories\frontend\PageRepository;
use yii\web\Controller;

class AppControllers extends Controller
{
    public $contacts;
    public $page;
    public $pages;
    public $client;
    public $materials;

    public function __construct($id, $module, PageRepository $pages, $config = [])
    {
        $this->client = new ClientForm();
        $this->materials = (new MaterialHelper())->material((new MaterialRepository())->getMaterials());
        $this->pages = $pages->getPages();
        parent::__construct($id, $module, $config);
    }

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