<?php

namespace common\querys;

use common\models\CartItems;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[CartItems]].
 *
 * @see CartItems
 */
class CartItemsQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return CartItems[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return array|ActiveRecord|null
     */
    public function one($db = null): array|ActiveRecord|null
    {
        return parent::one($db);
    }

    public function findByResourceId($resource_id): CartItemsQuery
    {
       return $this->andWhere(['resource_id' => $resource_id]);
    }

    public function findByCartId($cart_id): CartItemsQuery
    {
       return $this->andWhere(['cart_id' => $cart_id]);
    }

    public function findByCartAndResource($resource_id, $cart_id): CartItemsQuery
    {
        return $this->findByResourceId($resource_id)->findByCartId($cart_id);
    }
}
