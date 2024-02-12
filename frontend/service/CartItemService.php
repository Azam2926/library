<?php

namespace frontend\service;


use common\models\CartItems;
use common\models\Carts;
use common\models\Resource;
use frontend\dto\CartDTO;
use frontend\repository\CartItemRepository;
use Yii;
use yii\base\Component;
use yii\db\Exception;
use yii\db\StaleObjectException;
use Throwable;

class CartItemService extends Component
{

    public CartItemRepository $cartItemRepository;

    public function __construct(
        CartItemRepository $cartItemRepository,
        $config = [])
    {
        parent::__construct($config);
        $this->cartItemRepository = $cartItemRepository;
    }

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
    public function updateCartQuantity(CartItems $cartItemModel, CartDTO $cartDTO): CartItems
    {
        return $this->updateQuantity($cartItemModel, $cartDTO->getQuantity());
    }

    /**
     * @throws Exception
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function updateQuantity(CartItems $cartItemModel, $quantity): CartItems
    {
        $cartItemModel->quantity += $quantity;

        if(!$cartItemModel->update())
        {
            throw new Exception("Not updated!!");
        }

        return $cartItemModel;
    }

    /**
     * @throws Exception
     */
    public function getCartItem($resource_id, $cart_id): CartItems|array
    {
        $cartItemModel = $this->cartItemRepository->findByCartAndResource($resource_id, $cart_id);

        if(!$cartItemModel)
        {
            throw new Exception("Not found cart item");
        }

        return $cartItemModel;
    }


    /**
     * @throws Exception
     * @throws Throwable
     */
    public function removeCartItem($resource_id, $cart_id): bool|int
    {
       $cartItemModel =  $this->getCartItem($resource_id, $cart_id);

       return $cartItemModel->delete();
    }

    public function removeCartItemAll($cart_id): int
    {
        return $this->cartItemRepository->removeAllByCart($cart_id);
    }
}