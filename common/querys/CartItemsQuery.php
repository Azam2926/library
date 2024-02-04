<?php

namespace common\querys;

/**
 * This is the ActiveQuery class for [[\common\models\CartItems]].
 *
 * @see \common\models\CartItems
 */
class CartItemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CartItems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CartItems|array|null
     */
    public function one($db = null)
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

    public function findByCardAndResource($resource_id, $cart_id): CartItemsQuery
    {
        return $this->findByResourceId($resource_id)->findByCartId($cart_id);
    }
}
