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

}