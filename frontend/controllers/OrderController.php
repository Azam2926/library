<?php

namespace frontend\controllers;

use common\models\UserDetails;
use frontend\forms\OrderForm;
use frontend\service\CartService;
use Yii;
use yii\db\Exception;
use yii\web\Controller;

class OrderController extends Controller
{
    public CartService $cartService;

    public function __construct($id, $module,
                                CartService $cartService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cartService = $cartService;
    }

    /**
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $orderForm = new OrderForm();

        $this->layout = 'cart';
        return $this->render('index', [
            'modelData' => $this->cartService->getUserCartData(),
            'form' => $orderForm
        ]);
    }

    public function actionCreate()
    {

    }

    public function actionView($id)
    {
            
    }

}
