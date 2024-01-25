<?php

namespace backend\controllers;

use backend\form\ResourceShowerCreateForm;
use backend\form\ResourceShowerUpdateForm;
use backend\repositories\ResourceRepository;
use backend\repositories\ResourceShowerRepository;
use backend\service\ResourceShowerService;
use common\models\ResourceShower;
use backend\models\ResourceShowerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResourceShowerController implements the CRUD actions for ResourceShower model.
 */
class ResourceShowerController extends Controller
{
    public ResourceShowerRepository $resourceShowerRepository;
    public ResourceRepository $resourceRepository;
    public ResourceShowerService $resourceShowerService;

    public function __construct($id, $module,
                                ResourceShowerService $resourceShowerService,
                                ResourceShowerRepository $resourceShowerRepository,
                                ResourceRepository $resourceRepository,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->resourceShowerRepository = $resourceShowerRepository;
        $this->resourceRepository = $resourceRepository;
        $this->resourceShowerService = $resourceShowerService;
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ResourceShower models.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ResourceShowerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResourceShower model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->resourceShowerRepository->findByid($id),
        ]);
    }

    /**
     * Creates a new ResourceShower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $createForm = new ResourceShowerCreateForm();
        $model = new ResourceShower();

//        dd($createForm->load($this->request->post()));

        if ($this->request->isPost) {
            if ($createForm->load($this->request->post())) {
                $this->resourceShowerService->create($createForm);
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'createForm' => $createForm,
            'resources' => $this->resourceRepository->getResourceList(),
        ]);
    }

    /**
     * Updates an existing ResourceShower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $createForm = new ResourceShowerCreateForm();
        $model = $this->resourceShowerRepository->findByid($id);

//        dd($this->request->post());

        if($this->request->isPost){
            if($createForm->load($this->request->post())){
                $this->resourceShowerService->update($createForm);
                return $this->redirect('index');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'createForm' => $createForm,
            'resources' => $this->resourceRepository->getResourceList(),
        ]);
    }

    /**
     * Deletes an existing ResourceShower model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ResourceShower model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ResourceShower the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResourceShower::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
