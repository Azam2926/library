<?php

namespace backend\repositories;


use common\models\ResourceImages;

class ResourceImagesRepository
{
    public function findByResourceId($resource_id): array
    {
        return  ResourceImages::find()->resourceId($resource_id)->all();
    }
}