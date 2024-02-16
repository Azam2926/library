<?php

namespace frontend\service;


use backend\repositories\ResourceRepository;
use common\models\Order;
use common\models\Resource;
use common\models\UserDetails;
use frontend\dto\CartItemResponseDTO;
use frontend\forms\OrderForm;
use frontend\repository\OrderRepository;
use Yii;
use yii\base\Component;
use yii\db\Exception;


class OrderService extends Component
{

    public OrderRepository $orderRepository;
    public ResourceRepository $resourceRepository;

    public function __construct(
                                OrderRepository $orderRepository,
                                ResourceRepository $resourceRepository,
                                $config = [])
    {
        parent::__construct($config);
        $this->orderRepository = $orderRepository;
        $this->resourceRepository = $resourceRepository;
    }

    public function addOrder(CartItemResponseDTO $dto, UserDetails $model)
    {
        $orderModel = $this->orderRepository->findByUserId(Yii::$app->user->id);
        if(!$orderModel)
        {
            $orderModel = new Order();
            $orderModel->user_id = Yii::$app->user->id;

            $orderModel->save();
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