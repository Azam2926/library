<?php

namespace frontend\service;


use backend\repositories\ResourceRepository;
use backend\repositories\SubjectRepository;
use common\models\CartItems;
use common\models\Carts;
use common\models\Subject;
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

    public function __construct(CartRepository $cartRepository,
                                ResourceRepository $resourceRepository,
                                $config = [])
    {
        parent::__construct($config);
        $this->cartRepository = $cartRepository;
        $this->resourceRepository = $resourceRepository;
    }

    public function addToCartWithQuantity($id, $quantity): CartItems
    {
        $cartModel = $this->cartRepository->findByUserId(Yii::$app->user->id);
        if(!$cartModel){
            $cartModel = new Carts();

            $cartModel->created_by = Yii::$app->user->id;
            $cartModel->status = Carts::STATUS_ACTIVE;
            $cartModel->save();

        }

        $resourceModel = $this->resourceRepository->findById($id);
        if(!$resourceModel){
            throw new Exception("Resource not found");
        }

        $cartItem = new CartItems();

        $cartItem->cart_id = $cartModel->id;
        $cartItem->resource_id = $resourceModel->id;
        $cartItem->price = $resourceModel->price;
        $cartItem->quantity = $quantity;

        $cartItem->save();

        return $cartItem;

    }


    /**
     * @throws Exception
     */
    public function addToCart($id): CartItems
    {
        $quantity = 1;

       return $this->addToCartWithQuantity($id, $quantity);

    }



}