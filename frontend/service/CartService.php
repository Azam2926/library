<?php

namespace frontend\service;


use backend\repositories\ResourceRepository;
use common\models\CartItems;
use common\models\Carts;
use common\models\Resource;
use frontend\dto\CartDTO;
use frontend\dto\CartItemInlineDTO;
use frontend\dto\CartItemResponseDTO;
use frontend\dto\UserCartDataDTO;
use frontend\repository\CartItemRepository;
use frontend\repository\CartRepository;
use Yii;
use yii\base\Component;
use yii\db\Exception;
use yii\db\StaleObjectException;
use Throwable;

class CartService extends Component
{

    public CartRepository $cartRepository;
    public ResourceRepository $resourceRepository;
    public CartItemService $cartItemService;
    public CartItemRepository $cartItemRepository;

    public function __construct(
                                CartRepository $cartRepository,
                                ResourceRepository $resourceRepository,
                                CartItemRepository $cartItemRepository,
                                CartItemService $cartItemService,
                                $config = [])
    {
        parent::__construct($config);
        $this->cartRepository = $cartRepository;
        $this->resourceRepository = $resourceRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->cartItemService = $cartItemService;
    }

    /**
     * @throws Exception
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function saveCart(CartDTO $cartDTO): CartItems
    {
        $cartModel = $this->cartRepository->findByUserId(Yii::$app->user->id);
        if(!$cartModel){
            $cartModel = new Carts();

            $cartModel->created_by = Yii::$app->user->id;
            $cartModel->status = Carts::STATUS_ACTIVE;
            $cartModel->save();

        }

        $resourceModel = $this->getResource($cartDTO->getUuid());

        $cartItemModel = $this->cartItemRepository->findByCartAndResource($resourceModel->id, $cartModel->id);

        if($cartItemModel){

           $cartItemModel = $this->cartItemService->updateCartQuantity($cartItemModel, $cartDTO);
        }
        else{
            $cartItemModel = $this->cartItemService->saveCartItem($cartModel, $resourceModel, $cartDTO);
        }

        return $cartItemModel;

    }


    /**
     * @throws Exception
     * @throws Throwable
     */
    public function addToCart(CartDTO $cartDTO): CartItems
    {

        if($cartDTO->getQuantity() == null){
            $cartDTO->setQuantity( 1);
        }

       return $this->saveCart($cartDTO);

    }

    public function getCurrentUserCart($user_id): array
    {
        $cartResponseArray = [];

        $cartModel = $this->cartRepository->findByUserId($user_id);

        if(!$cartModel)
        {
            $cartResponseArray['user'] = [];
            $cartResponseArray['cartItem'] = [];

            return $cartResponseArray;
        }


        $cartResponseArray['user']['username'] = $cartModel->user->username;
        $cartResponseArray['user']['user_id'] = $cartModel->user->id;


        $cartResponseArray['cartItems'] = [];
        if(!empty($cartModel->cartItems))
        {

            $arr = [];
            foreach ($cartModel->cartItems as $cartItem) {
                $arr['uuid'] = $cartItem->resource->uuid;
                $arr['url'] = $cartItem->resource->getFirstImageUrlFront();
                $arr['title'] = $cartItem->resource ? $cartItem->resource->title : "";
                $arr['quantity'] = $cartItem->quantity;
                $arr['price'] = $cartItem->price;

                $cartResponseArray['cartItem'][] = $arr;
            }
        }

        return $cartResponseArray;
    }

    /**
     * @throws Exception
     * @return CartItemResponseDTO
     */
    public function getUserCartItems(): CartItemResponseDTO
    {
        $cartItemResponseDTO = new CartItemResponseDTO();

        $cartModel = $this->getCart(Yii::$app->user->id);

        if(!empty($cartModel->cartItems))
        {
            foreach ($cartModel->cartItems as $cartItem)
            {
                $cartItemInlineDTO = new CartItemInlineDTO();
                $cartItemInlineDTO->setUrl($cartItem->resource->getFirstImageUrlFront());
                $cartItemInlineDTO->setName($cartItem->resource ? $cartItem->resource->title : "");
                $cartItemInlineDTO->setPrice($cartItem->price);
                $cartItemInlineDTO->setQuantity($cartItem->quantity);
                $cartItemInlineDTO->setUUID($cartItem->resource->uuid);

                $cartItemResponseDTO->setCartItemInlineDTO($cartItemInlineDTO);
            }

            return $cartItemResponseDTO;
        }
        return $cartItemResponseDTO;
    }

    /**
     * @throws Exception
     */
    public function getUserCartData(): UserCartDataDTO
    {
        $userCartDataDTO = new UserCartDataDTO();
        $userCartDataDTO->setCartItemResponseDTO($this->getUserCartItems());
        $userCartDataDTO->setCartId($this->getCart(Yii::$app->user->id)->id);

        return $userCartDataDTO;
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function removeCartItem($uuid): bool|int
    {
        $cartModel = $this->getCart(Yii::$app->user->id);
        $resourceModel = $this->getResource($uuid);

        return $this->cartItemService->removeCartItem($resourceModel->id, $cartModel->id);
    }

    /**
     * @throws Exception
     */
    public function removeCartItemAll(): int
    {
        $cartModel = $this->getCart(Yii::$app->user->id);

        return $this->cartItemService->removeCartItemAll($cartModel->id);
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function changeCartQuantity(CartDTO $cartDTO): void
    {
        $cartModel = $this->getCart(Yii::$app->user->id);
        $resourceModel = $this->getResource($cartDTO->getUuid());

        $cartItemModel = $this->cartItemService->getCartItem($resourceModel->id, $cartModel->id);

        $this->cartItemService->changeQuantity($cartItemModel, $cartDTO->getQuantity());

    }


    /**
     * @param $uuid
     * @return Resource
     * @throws Exception
     */
    public function getResource($uuid): Resource
    {
        $resourceModel = $this->resourceRepository->findByUUID($uuid);

        if(!$resourceModel){
            throw new Exception("Resource not found");
        }

        return $resourceModel;
    }

    /**
     * @param $user_id
     * @return array|Carts
     * @throws Exception
     */
    public function getCart($user_id): array|Carts
    {
        $cartModel = $this->cartRepository->findByUserId($user_id);

        if(!$cartModel){
            throw new Exception("Cart not found");
        }

        return $cartModel;
    }



}