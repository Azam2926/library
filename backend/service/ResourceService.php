<?php

namespace backend\service;

use backend\form\ResourceForm;
use backend\repositories\ResourceRepository;
use common\models\Resource;
use Throwable;
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

    /**
     * @param ResourceForm $form
     * @return Resource
     */

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
     * @param ResourceForm $form
     * @param Resource $resource
     * @return Resource
     */
    public function update(ResourceForm $form, Resource $resource): Resource
    {

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
            $this->resourceImagesService->deleteAll($resource->id);
            $this->resourceImagesService->create($form, $resource);
        }

        return $resource;
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function delete(int $id): void
    {
        $model = $this->resourceRepository->findById($id);

        if (!$model) {
            throw new Exception('Resource shower not found');
        }

        $model->delete();
    }

    /**
     * @param $uuid
     * @return Resource
     * @throws Exception
     */
    public function getResource($uuid): Resource
    {
        $resourceModel = $this->resourceRepository->findByUUID($uuid);

        if(!$resourceModel){
            throw new Exception("Resource not found");
        }

        return $resourceModel;
    }

}