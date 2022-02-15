<?php

namespace core\services;

use core\entities\Project;
use core\forms\ProjectFrom;
use core\repositories\ProjectRepository;

class ProjectService
{
    private $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    public function create(ProjectFrom $from)
    {
        $project = Project::create(
            $from->title,
            $from->square,
            $from->count_floors,
            $from->description,
            $from->prise,
            $from->popular,
            $from->material,
            $from->filter,
        );
        foreach ($from->images as $image) {
            $project->addImage($image);
        }
        $this->projects->saveProject($project);
        return $project;
    }

    public function edit($id, ProjectFrom $from)
    {
        $project = $this->projects->getProject($id);
        $project->edit(
            $from->title,
            $from->square,
            $from->count_floors,
            $from->description,
            $from->prise,
            $from->popular,
            $from->material,
            $from->filter,
        );
        foreach ($from->images as $image) {
            $project->addImage($image);
        }
        $this->projects->saveProject($project);
        return $project;
    }
}