<?php

namespace backend\controllers;

use backend\form\ResourceShowerCreateForm;
use backend\repositories\ResourceRepository;
use backend\repositories\ResourceShowerRepository;
use backend\service\ResourceShowerService;
use common\models\ResourceShower;
use backend\models\ResourceShowerSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

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
    public function actionIndex(): string
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
     * @throws Exception
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->resourceShowerRepository->findById($id),
        ]);
    }

    /**
     * Creates a new ResourceShower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate(): Response|string
    {
        $createForm = new ResourceShowerCreateForm();
        $model = new ResourceShower();

        if ($this->request->isPost && $createForm->load($this->request->post())) {
            $this->resourceShowerService->create($createForm);
            return $this->redirect('index');
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
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $id): Response|string
    {
        $createForm = new ResourceShowerCreateForm();
        $model = $this->resourceShowerRepository->findById($id);

        if($this->request->isPost && $createForm->load($this->request->post())){
            $this->resourceShowerService->update($createForm);
            return $this->redirect('index');
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
     * @return Response
     * @throws Exception
     */
    public function actionDelete(int $id): Response
    {
        try {
            $this->resourceShowerService->delete($id);
        } catch (Exception|\Throwable $e) {
            throw new Exception($e->getMessage());
        }
        return $this->redirect(['index']);
    }
}
