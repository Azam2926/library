<?php

namespace frontend\service;


use common\models\CartItems;
use common\models\Carts;
use common\models\Resource;
use frontend\dto\CartDTO;
use Yii;
use yii\base\Component;
use yii\db\Exception;
use yii\db\StaleObjectException;
use Throwable;

class CartItemService extends Component
{
    /**
     * @throws Exception
     */
    public function saveCartItem(Carts $cartModel, Resource $resourceModel, CartDTO $cartDTO): CartItems
    {
        $cartItemModel = new CartItems();

        $cartItemModel->cart_id = $cartModel->id;
        $cartItemModel->resource_id = $resourceModel->id;
        $cartItemModel->price = $resourceModel->price;
        $cartItemModel->quantity = $cartDTO->getQuantity();

        if(!$cartItemModel->save()){
            throw new Exception("Not saved !!!");
        }

        return $cartItemModel;
    }

    /**
     * @throws Exception
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function updateQuantity(CartItems $cartItemModel, CartDTO $cartDTO): CartItems
    {
        $cartItemModel->quantity += $cartDTO->getQuantity();

        if(!$cartItemModel->update())
        {
            throw new Exception("Not updated!!");
        }

        return $cartItemModel;
    }
}