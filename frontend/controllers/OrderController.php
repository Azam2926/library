<?php

namespace frontend\controllers;

class OrderController extends \yii\web\Controller
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
