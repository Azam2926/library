<?php

namespace frontend\repository;

use common\models\Carts;
use common\models\Resource;
use common\models\Subject;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class CartRepository
{

    public function findByUserId($user_id)
    {
        return Carts::find()->findByUserId($user_id)->one();
    }
}