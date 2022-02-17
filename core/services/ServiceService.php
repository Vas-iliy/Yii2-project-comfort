<?php

namespace core\services;

use core\entities\Service;
use core\entities\ServiceImage;
use core\forms\ServiceFrom;
use core\repositories\ServiceRepository;

class ServiceService
{
    private $services;

    public function __construct(ServiceRepository $services)
    {
        $this->services = $services;
    }

    public function create(ServiceFrom $form)
    {
        $service = Service::create(
            $form->title,
            $form->items,
            $form->description,
            $form->status ?? null
        );
        $this->transaction($service, $form);
        return $service;
    }

    public function edit($id, ServiceFrom $form)
    {
        $service = $this->services->get($id);
        $service->edit(
            $form->title,
            $form->items,
            $form->description,
            $form->status ?? null
        );
        $this->transaction($service, $form);
        return $service;
    }

    public function remove($id)
    {
        $service = $this->services->get($id);
        $this->services->remove($service);
    }

    public function deleteImage(ServiceImage $image)
    {
        if ($image) {
            $arr = explode('.', $image->image);
            $extension = $arr[count($arr)-1];
            if (unlink(\Yii::getAlias("@staticRoot/origin/services/{$image->id}") . '.' . $extension)) {
                $image->delete();
                return true;
            }
        }
        return false;
    }

    private function transaction(Service $service, ServiceFrom $form)
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        if (!$this->services->save($service) || !$this->createImages($form, $service)) {
            $transaction->rollBack();
        }
        $transaction->commit();
    }

    private function createImages(ServiceFrom $form, Service $service)
    {
        foreach ($form->images as $image) {
            $image = ServiceImage::create($image, $service->id);
            if (!$image->save()) {
                return false;
            }
        }
        return true;
    }
}