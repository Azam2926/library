<?php

namespace frontend\repository;

use common\models\CartItems;

class CartItemRepository
{

    public function findByCartAndResource($resource_id, $cart_id): CartItems|array|null
    {
        return CartItems::find()->findByCartAndResource($resource_id, $cart_id)->one();
    }
}