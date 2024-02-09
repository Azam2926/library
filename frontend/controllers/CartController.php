<?php

namespace frontend\controllers;

use frontend\dto\CartDTO;
use frontend\service\CartService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\Response;

class CartController extends Controller
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
        $this->layout = 'cart';
        return $this->render('index', [
            'model' => $this->cartService->getUserCartItems(),
        ]);
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function actionAddToCart(): Response|array|string
    {
        if (Yii::$app->user->isGuest) {

            Yii::$app->getResponse()->setStatusCode(401, "Unauthorized");
            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'status' => 'Error',
                'message' => 'Unauthorized',
                'data' => null
            ];
        } else {
            if (Yii::$app->request->isAjax) {

                $cartDTO = new CartDTO(Yii::$app->request->post());

                $this->cartService->addToCart($cartDTO);

                $cartItems = $this->cartService->getCurrentUserCart(Yii::$app->user->id);

                return $this->renderAjax('cart', [
                    'cartItems' => $cartItems,
                ]);

            } else {
                return $this->render('index');
            }
        }
    }

    public function actionUserCart(): string
    {
        if (Yii::$app->user->isGuest)
            return $this->renderPartial('cart', [
                'cartItems' => ['cartItem' => []],
            ]);
        // Assuming you have a method to retrieve cart items, replace this with your logic
        $user_id = Yii::$app->user->id;
        $cartItems = $this->cartService->getCurrentUserCart($user_id); // Assuming you have a cart component

        // Pass cart items to the view
        return $this->renderPartial('cart', [
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * @throws Throwable
     * @throws Exception
     */
    public function changeCartQuantity(): void
    {
        if(Yii::$app->request->isAjax)
        {
            $cartDTO = new CartDTO(Yii::$app->request->post());
            $this->cartService->changeCartQuantity($cartDTO);
        }

    }

}
