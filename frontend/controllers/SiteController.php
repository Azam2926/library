<?php

namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Resource;
use common\models\ResourceShower;
use frontend\models\ResourceFilter;
use frontend\models\SignupForm;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{
    #[ArrayShape(['error' => "string[]"])]
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionResources(): string
    {
        $searchModel = new ResourceFilter();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if (Yii::$app->request->isAjax)
            return $this->renderAjax('resources_list', ['dataProvider' => $dataProvider]);

        return $this->render('resources', [
            'filterModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionResource($uuid): string
    {
        $resource = $this->findResourceWithVD($uuid);
        return $this->render('resource_view', [
            'resource' => $resource,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function findResourceWithVD($uuid): Resource
    {
        $model = Resource::find()->uuid($uuid)->one();
        if (!$model)
            throw new NotFoundHttpException('Resurs topilmadi');

        return $model;
    }

    public function actionIndex(): string
    {
        $new_resource_counter = 3;
        $this->layout = 'home';
        return $this->render('index', [
            'new_resources' => Resource::find()->news($new_resource_counter)->all(),
            'featured_books' => array_map(fn($item) => $item->resource, ResourceShower::find()->findByType(ResourceShower::FEATURE)->all()),
        ]);
    }

    #[Pure] #[ArrayShape(['access' => "array", 'verbs' => "array"])] public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return string|Response
     */
    public function actionLogin(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionSignup(): string|Response
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['site/index']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Slider render
     *
     * @return string|Response
     */
    public function actionSlider(): string|Response
    {
        return $this->renderPartial('slider', [
            'books' => array_map(fn($item) => $item->resource, ResourceShower::find()->findByType(ResourceShower::SLIDER)->all()),
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function findResource($uuid): array|Resource|null
    {
        $model = Resource::find()->uuid($uuid)->one();
        if (!$model)
            throw new NotFoundHttpException('Resurs topilmadi');

        return $model;
    }
}
