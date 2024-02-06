<?php

namespace frontend\service;


use backend\repositories\ResourceRepository;
use common\models\CartItems;
use common\models\Carts;
use frontend\dto\CartDTO;
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

        $resourceModel = $this->resourceRepository->findById($cartDTO->getResourceId());

        if(!$resourceModel){
            throw new Exception("Resource not found");
        }

        $cartItemModel = $this->cartItemRepository->findByCardAndResource($resourceModel->id, $cartModel->id);

        if($cartItemModel){

           $cartItemModel = $this->cartItemService->updateQuantity($cartItemModel, $cartDTO);
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
        $cartResponseArray['user']['status'] = $cartModel->user->status;


        $cartResponseArray['cartItem'] = [];
        if(!empty($cartModel->cartItems))
        {

            $arr = [];
            foreach ($cartModel->cartItems as $cartItem) {
                $arr['url'] = $cartItem->resource->getFirstImageUrlFront();
                $arr['title'] = $cartItem->resource ? $cartItem->resource->title : "";
                $arr['quantity'] = $cartItem->quantity;
                $arr['price'] = $cartItem->price;

                $cartResponseArray['cartItem'][] = $arr;
            }
        }

        return $cartResponseArray;
    }



}