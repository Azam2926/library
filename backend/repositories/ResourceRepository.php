<?php

namespace backend\repositories;


use common\models\Resource;
use yii\helpers\ArrayHelper;

class ResourceRepository
{
    /**
     * @return array
     */

    public function getResourceList(): array
    {
        return  ArrayHelper::map(Resource::find()->active()->asArray()->all(),'id', 'title');
    }

    /**
     * @param $id
     * @return Resource|null
     */

    public function findById($id): ?Resource
    {
        return Resource::find()->findById($id)->one();
    }

    /**
     * @param $uuid
     * @return Resource|null
     */

    public function findByUUID($uuid): ?Resource
    {
        return Resource::find()->uuid($uuid)->one();
    }


}