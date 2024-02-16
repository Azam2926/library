<?php

namespace frontend\service;


use backend\repositories\ResourceRepository;
use common\models\CartItems;
use common\models\Order;
use common\models\OrderList;
use common\models\Resource;
use common\models\UserDetails;
use frontend\dto\CartItemResponseDTO;
use frontend\repository\CartItemRepository;
use frontend\repository\OrderRepository;
use Throwable;
use Yii;
use yii\base\Component;
use yii\db\Exception;


class OrderService extends Component
{

    public OrderRepository $orderRepository;
    public ResourceRepository $resourceRepository;
    public CartItemRepository $cartItemRepository;

    public function __construct(
                                OrderRepository $orderRepository,
                                ResourceRepository $resourceRepository,
                                CartItemRepository $cartItemRepository,
                                $config = [])
    {
        parent::__construct($config);
        $this->orderRepository = $orderRepository;
        $this->resourceRepository = $resourceRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    /**
     * @param CartItems[] $cartItems
     * @throws Exception
     * @throws Throwable
     */
    public function addOrder(array $cartItems): void
    {
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $orderModel = $this->orderRepository->findByUserId(Yii::$app->user->id);

            if(!$orderModel)
            {
                $orderModel = new Order();
                $orderModel->user_id = Yii::$app->user->id;
                $orderModel->save();
            }

            foreach ($cartItems as $cartItem)
            {
                $orderListModel = new OrderList();

                $orderListModel->order_id = $orderModel->id;
                $orderListModel->resource_id = $cartItem->resource_id;
                $orderListModel->quantity = $cartItem->quantity;
                $orderListModel->price = $cartItem->quantity * $cartItem->price;

                if(!$orderListModel->save()){
                    throw new Exception("Failed to save order list");
                }

                $cartItem->delete();
            }

            $transaction->commit();
        }catch (Exception $e)
        {
            $transaction->rollBack();
            Yii::error("Transaction failed: " . $e->getMessage());
        }
    }

    /**
     * @param $user_id
     * @return array|Order
     * @throws Exception
     */
    private function getOrder($user_id): array|Order
    {
        $orderModel = $this->orderRepository->findByUserId($user_id);

        if(!$orderModel){
            throw new Exception("Order not found");
        }

        return $orderModel;
    }

    /**
     * @param $uuid
     * @return Resource
     * @throws Exception
     */
    private function getResource($uuid): Resource
    {
        $resourceModel = $this->resourceRepository->findByUUID($uuid);

        if(!$resourceModel){
            throw new Exception("Resource not found");
        }

        return $resourceModel;
    }



}