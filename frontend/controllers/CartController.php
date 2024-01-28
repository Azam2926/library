<?php

namespace frontend\controllers;

use frontend\service\CartService;
use Yii;
use yii\web\Response;

class CartController extends \yii\web\Controller
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

    public function actionAddToCart()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }
        else{
            if(Yii::$app->request->isAjax){

                $id = Yii::$app->request->post('resource_id');
                $cartItem = $this->cartService->addToCart($id);

                Yii::$app->response->format = Response::FORMAT_JSON;

                return ['status' => 'success', 'result' => $cartItem];
            }
            else{
                return $this->render('index');
            }
        }
    }

}
