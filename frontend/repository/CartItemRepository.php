<?php

namespace frontend\repository;

use common\models\CartItems;

class CartItemRepository
{

    public function findByCardAndResource($resource_id, $card_id): CartItems|array|null
    {
        return CartItems::find()->findByCardAndResource($resource_id, $card_id)->one();
    }
}