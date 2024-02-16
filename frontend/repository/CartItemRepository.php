<?php

namespace frontend\repository;

use common\models\CartItems;

class CartItemRepository
{

    public function findByCartAndResource($resource_id, $cart_id): CartItems|array|null
    {
        return CartItems::find()->findByCartAndResource($resource_id, $cart_id)->one();
    }

    public function getCartItemList($cart_id): array
    {
        return CartItems::find()->findByCartId($cart_id)->all();
    }

    public function removeAllByCart($cart_id): int
    {
        return CartItems::deleteAll(['cart_id' => $cart_id]);
    }

    public function removeByResource($resource_id)
    {

    }
}