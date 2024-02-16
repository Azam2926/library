<?php

namespace frontend\controllers;

use common\models\UserDetails;
use frontend\service\CartService;
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
        $userDetails = new UserDetails();

        $this->layout = 'cart';
        return $this->render('index', [
            'model' => $this->cartService->getUserCartItems(),
            'userDetails' => $userDetails
        ]);
    }

    public function actionCreate()
    {

    }

    public function actionView($id)
    {
            
    }

}
