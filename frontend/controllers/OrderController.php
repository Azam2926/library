<?php

namespace frontend\controllers;

use common\models\UserDetails;
use frontend\service\CartService;
use frontend\service\OrderService;
use frontend\service\UserDetailsService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\Response;

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
    public function actionIndex(): Response|string
    {
        $model = new UserDetails();

        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            $this->orderService->addOrder($this->cartService->getCartItemList());
            $this->userDetailsService->update($model);

            return $this->render('index', [
                'cartData' => $this->cartService->getUserCartItems(),
                'model' => new UserDetails()
            ]);

        }

        $cartItems = $this->cartService->getUserCartItems();
        if (empty($cartItems->getItems()))
            return $this->redirect("site");

        return $this->render('index', [
            'cartData' => $cartItems,
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
