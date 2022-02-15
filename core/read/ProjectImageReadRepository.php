<?php

namespace core\read;

use core\entities\Project;
use core\entities\ProjectImage;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class ProjectImageReadRepository
{
    public function getImages($id)
    {
        $query = ProjectImage::find()->where(['project_id' => $id])->with('filter', 'images', 'material');
        return $this->getProvider($query);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}