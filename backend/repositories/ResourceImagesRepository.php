<?php

namespace backend\repositories;


use common\models\Resource;
use common\models\ResourceImages;
use common\models\Subject;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class ResourceImagesRepository
{
    public function findByResourceId($resource_id): array
    {
        return  ResourceImages::find()->resourceId($resource_id)->all();
    }
}