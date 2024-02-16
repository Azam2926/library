<?php

namespace frontend\controllers;

use common\models\UserDetails;
use frontend\dto\CartItemResponseDTO;
use frontend\service\CartService;
use frontend\service\OrderService;
use frontend\service\UserDetailsService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\web\Controller;

class OrderController extends Controller
{
    public CartService $cartService;
    public OrderService $orderService;
    public UserDetailsService $userDetailsService;

    public function __construct($id, $module,
                                UserDetailsService $userDetailsService,
                                CartService $cartService,
                                OrderService $orderService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->userDetailsService = $userDetailsService;
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function actionIndex(): string
    {
        $model = new UserDetails();

        if(Yii::$app->request->post() && $model->load(Yii::$app->request->post()))
        {
            $this->orderService->addOrder($this->cartService->getCartItemList());
            $this->userDetailsService->update($model);

            return $this->render('index', [
                'cartData' => $this->cartService->getUserCartItems(),
                'model' => new UserDetails()
            ]);

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
