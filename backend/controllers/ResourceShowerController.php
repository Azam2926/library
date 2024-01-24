<?php

namespace backend\controllers;

use backend\dto\ResourceShowerCreateDTO;
use backend\form\ResourceShowerForm;
use backend\repositories\ResourceShowerRepository;
use backend\service\ResourceShowerService;
use common\helpers\ResourceShowerHelper;
use common\models\enum\ResourceShowerEnum;
use common\models\ResourceShower;
use backend\models\ResourceShowerSearch;
use ReflectionClass;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResourceShowerController implements the CRUD actions for ResourceShower model.
 */
class ResourceShowerController extends Controller
{

    public $resourceShowerRepository;
    public $resourceShowerService;

    public function __construct($id, $module,ResourceShowerService $resourceShowerService, ResourceShowerRepository $resourceShowerRepository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->resourceShowerRepository = $resourceShowerRepository;
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
     *
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
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ResourceShower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ResourceShower();

        $createForm = new ResourceShowerForm();


        if ($this->request->isPost) {
            if ($createForm->load($this->request->post())) {
                $this->resourceShowerService->create($createForm);
                return $this->redirect('index');
            }
        }
//        else {
//            $model->loadDefaultValues();
//        }

        return $this->render('create', [
            'createForm' => $createForm,
            'resources' => $this->resourceShowerRepository->getResourceList(),
//            'positionList' => ResourceShowerHelper::getPositionList(),
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
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
