<?php

namespace frontend\service;


use backend\repositories\ResourceRepository;
use common\models\CartItems;
use common\models\Order;
use common\models\OrderList;
use common\models\Resource;
use frontend\repository\CartItemRepository;
use frontend\repository\OrderListRepository;
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
    public OrderListRepository $orderListRepository;

    public function __construct(
                                OrderRepository $orderRepository,
                                ResourceRepository $resourceRepository,
                                CartItemRepository $cartItemRepository,
                                OrderListRepository $orderListRepository,
                                $config = [])
    {
        parent::__construct($config);
        $this->orderRepository = $orderRepository;
        $this->resourceRepository = $resourceRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->orderListRepository = $orderListRepository;
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
                $orderListModel = $this->getOrderList($orderModel->id, $cartItem->resource_id);

                if($orderListModel)
                {
                    $orderListModel->quantity += $cartItem->quantity;
                    $orderListModel->price = $orderListModel->quantity * $cartItem->price;

                    $orderListModel->save();
                }
                else{
                    $orderListModel = new OrderList();

                    $orderListModel->order_id = $orderModel->id;
                    $orderListModel->resource_id = $cartItem->resource_id;
                    $orderListModel->quantity = $cartItem->quantity;
                    $orderListModel->price = $cartItem->quantity * $cartItem->price;

                    if(!$orderListModel->save()){
                        throw new Exception("Failed to save order list");
                    }
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

    /**
     * @param $orderId
     * @param $resourceId
     * @return OrderList|null
     */

    public function getOrderList($orderId, $resourceId): OrderList|null
    {
        return $this->orderListRepository->getOrderList($orderId, $resourceId);
    }



}