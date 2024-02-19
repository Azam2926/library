<?php

namespace frontend\repository;

use common\models\OrderList;

class OrderListRepository
{

    public function getOrderList($orderId, $resourceId): array|OrderList|null
    {
        return OrderList::find()->findByOrderAndResource($orderId, $resourceId)->one();
    }

}