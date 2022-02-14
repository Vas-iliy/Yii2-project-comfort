<?php

namespace backend\controllers;

use backend\providers\MapDataProvider;
use core\entities\Project;
use core\read\ProjectReadRepository;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    private $projects;

    public function __construct($id, $module, ProjectReadRepository $projects, $config = [])
    {
        $this->projects = $projects;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        /*$dataProvider = new ActiveDataProvider([
            'query' => Project::find(),

            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);*/
        $projects = $this->projects->getAll();
        return new MapDataProvider($projects, [$this, 'serializeListItem']);

    }

    /**
     * Displays a single Project model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function serializeListItem(Project $project): array
    {
        return [
            'id' => $project->id,
            'title' => $project->title,
            'square' => $project->square,
            'count' => $project->count_floors,
            'text' => $project->description,
            'price' => $project->prise,
            'popular' => $project->popular,
            '_links' => [
                'self' => ['href' => Url::to(['view', 'id' => $project->id], true)],
                'update' => ['href' => Url::to(['update', 'id' => $project->id], true)],
                'delete' => ['href' => Url::to(['delete', 'id' => $project->id], true)],
            ],
        ];
    }
}
