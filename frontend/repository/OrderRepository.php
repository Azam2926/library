<?php

namespace frontend\repository;

use common\models\Order;

class OrderRepository
{

    public function findByUserId($user_id): Order|array|null
    {
        return Order::find()->findByUserId($user_id)->one();
    }
}