<?php

namespace backend\repositories;


use common\models\Resource;
use yii\helpers\ArrayHelper;

class ResourceRepository
{
    public function getResourceList(): array
    {
        return  ArrayHelper::map(Resource::find()->active()->asArray()->all(),'id', 'title');
    }
    public function findById($id): ?Resource
    {
        return Resource::find()->findById($id)->one();
    }

    public function findByUUID($uuid): ?Resource
    {
        return Resource::find()->uuid($uuid)->one();
    }


}