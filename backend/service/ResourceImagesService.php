<?php

namespace backend\service;

use backend\form\ResourceForm;
use backend\repositories\ResourceImagesRepository;
use backend\repositories\ResourceRepository;
use backend\repositories\ResourceShowerRepository;
use common\models\Resource;
use common\models\ResourceImages;
use common\models\ResourceShower;
use yii\base\BaseObject;
use yii\base\Component;
use yii\db\Exception;

class ResourceImagesService extends Component
{

    public ResourceImagesRepository $imagesRepository;

    public function __construct(
        ResourceImagesRepository $resourceImagesRepository,
        $config = []
    )
    {
        parent::__construct($config);
        $this->imagesRepository = $resourceImagesRepository;
    }

    public function create(ResourceForm $form, Resource $resource): void
    {
        foreach ($form->images as $image) {
            $resource_image = new ResourceImages();
            $resource_image->resource_id = $resource->id;
            $resource_image->path = $image;
            if (!$resource_image->save()) {
                dd($resource_image->errors);
            }
        }

    }

    public function deleteAll($resource_id): void
    {
        ResourceImages::deleteAll(['resource_id' => $resource_id]);
    }

}