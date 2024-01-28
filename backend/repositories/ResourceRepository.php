<?php

namespace backend\repositories;


use common\models\Resource;
use yii\helpers\ArrayHelper;

class ResourceRepository
{
    public function getResourceList()
    {
        return  ArrayHelper::map(Resource::find()->active()->asArray()->all(),'id', 'title');
    }
    public function findById($id)
    {
        return Resource::find()->findById($id)->one();
    }


}