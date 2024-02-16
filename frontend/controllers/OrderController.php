<?php

namespace frontend\controllers;

use common\models\UserDetails;
use frontend\dto\CartItemResponseDTO;
use frontend\forms\OrderForm;
use frontend\service\CartService;
use frontend\service\OrderService;
use Yii;
use yii\db\Exception;
use yii\web\Controller;

class OrderController extends Controller
{
    public CartService $cartService;
    public OrderService $orderService;

    public function __construct($id, $module,
                                CartService $cartService,
                                OrderService $orderService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    /**
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $model = new UserDetails();

        if(Yii::$app->request->post() && $model->load(Yii::$app->request->post()))
        {
           $cartItemDTO = $this->cartService->getUserCartItems();
//            $this->orderService->addOrder($model, $cartItemDTO);
        }

        $this->layout = 'cart';
        return $this->render('index', [
            'cartData' => $this->cartService->getUserCartItems(),
            'model' => $model
        ]);
    }

    public function actionCreate()
    {

    }

    public function actionView($id)
    {
            
    }

}
