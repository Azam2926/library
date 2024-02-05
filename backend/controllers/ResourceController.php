<?php

namespace backend\controllers;

use backend\form\ResourceForm;
use backend\models\ResourceSearch;
use backend\repositories\ResourceRepository;
use backend\service\ResourceService;
use common\models\Resource;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ResourceController implements the CRUD actions for Resource model.
 */
class ResourceController extends AdminController
{

    public ResourceService $resourceService;
    public ResourceRepository $resourceRepository;


    public function __construct($id, $module,
                                ResourceService $resourceService,
                                ResourceRepository $resourceRepository,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->resourceService = $resourceService;
        $this->resourceRepository = $resourceRepository;
    }

    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Resource models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new ResourceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resource model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Resource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Resource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Resource
    {
        if (($model = Resource::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Resource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate(): string|Response
    {
        $model = new Resource();
        $form = new ResourceForm();
        if ($this->request->isPost) {
            if ($form->load($this->request->post())) {
                $newModel = $this->resourceService->create($form);
                return $this->redirect(['view', 'id' => $newModel->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'form' => $form
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionUpdate(int $id): string|Response
    {
        $updateForm = new ResourceForm();
        $model = $this->resourceRepository->findById($id);

        if ($this->request->isPost) {
            if($updateForm->load($this->request->post())){
                $newModel = $this->resourceService->update($updateForm, $model);
                return $this->redirect(['view', 'id' => $newModel->id]);
            }

        }
        return $this->render('update', [
            'model' => $model,
            'updateForm' => $updateForm
        ]);
    }

    /**
     * Deletes an existing Resource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        try {
            $this->findModel($id)->delete();
        } catch (StaleObjectException | NotFoundHttpException | \Throwable $e) {
        }

        return $this->redirect(['index']);
    }
}
