<?php

namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Resource;
use frontend\components\Stats;
use frontend\models\ResourceFilter;
use frontend\models\SignupForm;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
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

    public function actionResourceDownload($uuid): Response|string
    {
        $resource = $this->findResource($uuid);

        if (!$resource->file)
            throw new NotFoundHttpException('fayl yoq');

        $resource->updateDownloadCount();

        return 'ok';
    }

    public function actionResourceView($uuid): Response|string
    {
        $resource = $this->findResource($uuid);
        if (!$resource->file)
            throw new NotFoundHttpException('fayl yoq');

        $resource->updateViewCount();

        if ($resource->type == Resource::TYPE_YOUTUBEVIDEO)
            return $this->redirect($resource->youtubelink);

        return $this->redirect($resource->getUploadedFileUrlFromFrontend('file'));
    }

    public function actionResource($uuid): string
    {
        $resource = $this->findResourceWithVD($uuid);
        return $this->render('resource_view', [
            'resource' => $resource,
        ]);
    }

    public function actionIndex(): string
    {
        $new_resource_counter = 5;
        return $this->render('index', [
            'new_resources' => Resource::find()->news($new_resource_counter)->all(),
            'statistics' => (new Stats())->getStats(),
            'new_electron_resources' => Resource::find()->with('types')->newElectrons($new_resource_counter)->all(),
            'new_audio_resources' => Resource::find()->with('types')->newAudios($new_resource_counter)->all(),
            'new_video_resources' => Resource::find()->with('types')->newVideos($new_resource_counter)->all(),
        ]);
    }

    public function behaviors()
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
     * @return mixed
     */
    public function actionLogin()
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
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    private function findResource($uuid): array|Resource|null
    {
        $model = Resource::find()->uuid($uuid)->one();
        if (!$model)
            throw new NotFoundHttpException('Resurs topilmadi');

        return $model;
    }

    private function findResourceWithVD($uuid): array|Resource
    {
        $model = Resource::find()->with(['resourceDownload', 'resourceView'])->uuid($uuid)->one();
        if (!$model)
            throw new NotFoundHttpException('Resurs topilmadi');

        return $model;
    }
}
