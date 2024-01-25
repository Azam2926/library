<?php

namespace backend\repositories;


use common\models\ResourceShower;
use yii\db\Exception;

class ResourceShowerRepository
{
    public function findByid($id)
    {
        $model = ResourceShower::find()->findById($id)->one();
        if(!$model){
            throw new Exception("Resource not found");
        }

        return $model;
    }

    public function findByType($type)
    {
        $model = ResourceShower::find()->findById($id)->one();
        if(!$model){
            throw new Exception("Resource not found");
        }

        return $model;
    }

}