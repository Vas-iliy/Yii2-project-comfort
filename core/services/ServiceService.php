<?php

namespace core\services;

use core\entities\Project;
use core\entities\ProjectImage;
use core\forms\ProjectFrom;
use core\repositories\ProjectRepository;

class ServiceService
{
    private $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    public function create(ProjectFrom $form)
    {
        $project = Project::create(
            $form->title,
            $form->square,
            $form->count_floors,
            $form->description,
            $form->price,
            $form->popular,
            $form->material,
            $form->filter,
            $form->status ?? null
        );
        $this->transaction($project, $form);
        return $project;
    }

    public function edit($id, ProjectFrom $form)
    {
        $project = $this->projects->get($id);
        $project->edit(
            $form->title,
            $form->square,
            $form->count_floors,
            $form->description,
            $form->price,
            $form->popular,
            $form->material,
            $form->filter,
            $form->status ?? null
        );
        $this->transaction($project, $form);
        return $project;
    }

    public function remove($id)
    {
        $project = $this->projects->get($id);
        $this->projects->remove($project);
    }

    public function deleteImage(ProjectImage $image)
    {
        $projectId = $this->projects->getId($image->id);
        if ($image) {
            $arr = explode('.', $image->image);
            $extension = $arr[count($arr)-1];
            if (unlink(\Yii::getAlias("@staticRoot/origin/projects/{$projectId}/{$image->id}") . '.' . $extension)) {
                $image->delete();
                return true;
            }
        }
        return false;
    }

    private function transaction(Project $project, ProjectFrom $form)
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        if (!$this->projects->save($project) || !$this->createImages($form, $project)) {
            $transaction->rollBack();
        }
        $transaction->commit();
    }

    private function createImages(ProjectFrom $form, Project $project)
    {
        foreach ($form->images as $image) {
            $image = ProjectImage::create($image, $project->id);
            if (!$image->save()) {
                return false;
            }
        }
        return true;
    }
}