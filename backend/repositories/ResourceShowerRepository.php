<?php

namespace backend\repositories;


use common\models\ResourceShower;
use yii\db\Exception;

class ResourceShowerRepository
{
    /**
     * @throws Exception
     */
    public function findById($id): array|ResourceShower
    {
        $model = ResourceShower::find()->findById($id)->one();

        if(!$model){
            throw new Exception("Resource not found");
        }

        return $model;
    }

}