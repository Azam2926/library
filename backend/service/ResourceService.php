<?php

namespace backend\service;

use backend\form\ResourceForm;
use backend\repositories\ResourceRepository;
use backend\repositories\ResourceShowerRepository;
use common\models\Resource;
use common\models\ResourceImages;
use common\models\ResourceShower;
use yii\base\Component;
use yii\db\Exception;
use yii\web\UploadedFile;

class ResourceService extends Component
{

    public ResourceRepository $resourceRepository;
    public ResourceImagesService $resourceImagesService;

    public function __construct(
        ResourceRepository    $resourceRepository,
        ResourceImagesService $resourceImagesService,
                              $config = []
    )
    {
        parent::__construct($config);
        $this->resourceRepository = $resourceRepository;
        $this->resourceImagesService = $resourceImagesService;
    }

    public function create(ResourceForm $form): Resource
    {

        $resource = new Resource();
        $resource->subject_id = $form->subject_id;
        $resource->type_id = $form->type_id;
        $resource->title = $form->title;
        $resource->description = $form->description;
        $resource->publisher = $form->publisher;
        $resource->date = $form->date;
        $resource->language = $form->language;
        $resource->open_access = $form->open_access;
        $resource->price = $form->price;
        $resource->count = $form->count;
        $resource->status = Resource::STATUS_ACTIVE;

        $form->images = UploadedFile::getInstances($form, 'images');

        if ($resource->save()) {
            $this->resourceImagesService->create($form, $resource);
        }

        return $resource;

    }

    /**
     * @throws Exception
     */
    public function update($form): void
    {
        $form->id = intval($form->id);

        $model = $this->resourceShowerRepository->findById($form->id);

        if (!$model) {
            throw new Exception('Resource shower not found');
        }

        foreach ($form->resource_id as $id) {

            $model->resource_id = $id;
            $model->type = $form->type;
            $model->save();
        }
    }

    /**
     * @throws Exception
     * @throws \Throwable
     */
    public function delete(int $id): void
    {
        $model = $this->resourceShowerRepository->findById($id);

        if (!$model) {
            throw new Exception('Resource shower not found');
        }

        $model->delete();
    }

}