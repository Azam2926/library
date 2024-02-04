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


    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function actionAddToCart(): Response|array|string
    {
        if(Yii::$app->user->isGuest){

            Yii::$app->getResponse()->setStatusCode(401, "Unauthorized");

            return [
                'status' => 'Unsuccessfully',
                'result' => null
            ];
        }
        else{
            if(Yii::$app->request->isAjax){

                $cartDTO = new CartDTO(Yii::$app->request->post());

                $cartItem = $this->cartService->addToCart($cartDTO);

                Yii::$app->response->format = Response::FORMAT_JSON;

                return ['status' => 'success', 'result' => $cartItem];
            }
            else{
                return $this->render('index');
            }
        }
    }

}
