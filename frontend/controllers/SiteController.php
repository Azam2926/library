<?php

namespace frontend\controllers;

use common\models\Resource;
use frontend\components\Stats;
use frontend\models\ResourceFilter;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
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
        return $this->render('index', [
            'new_resources' => Resource::find()->news(6)->all(),
            'statistics' => (new Stats())->getStats(),
            'new_electron_resources' => Resource::find()->with('types')->newEelectrons(6)->all(),
            'new_audio_resources' => Resource::find()->with('types')->newAudios(6)->all(),
            'new_video_resources' => Resource::find()->with('types')->newVideos(6)->all(),
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
