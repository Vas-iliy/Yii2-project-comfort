<?php

namespace core\services;

use core\entities\Work;
use core\entities\WorkImage;
use core\forms\WorkFrom;
use core\repositories\WorkRepository;

class WorkService
{
    private $works;

    public function __construct(WorkRepository $works)
    {
        $this->works = $works;
    }

    public function edit($id, WorkFrom $form)
    {
        $work = $this->works->get($id);
        $work->edit(
            $form->description,
        );
        $this->transaction($work, $form);
        return $work;
    }

    public function deleteImage(WorkImage $image)
    {
        if ($image) {
            $arr = explode('.', $image->image);
            $extension = $arr[count($arr)-1];
            if (unlink(\Yii::getAlias("@staticRoot/origin/works/{$image->id}") . '.' . $extension)) {
                $image->delete();
                return true;
            }
        }
        return false;
    }

    private function transaction(Work $work, WorkFrom $form)
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        if (!$this->works->save($work) || !$this->createImages($form, $work)) {
            $transaction->rollBack();
        }
        $transaction->commit();
    }

    private function createImages(WorkFrom $form, Work $work)
    {
        foreach ($form->images as $image) {
            $image = WorkImage::create($image, $work->id);
            if (!$image->save()) {
                return false;
            }
        }
        return true;
    }
}