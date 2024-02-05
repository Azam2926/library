<?php

namespace frontend\controllers;

use yii\web\Controller;

class OrderController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionCreate()
    {

    }

    public function actionView($id)
    {
            
    }

}
