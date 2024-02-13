<?php

namespace frontend\controllers;

use frontend\service\ReviewService;
use yii\web\Controller;

class ReviewsController extends Controller
{
    public ReviewService $reviewService;

    public function __construct($id, $module,
                                ReviewService $reviewService,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->reviewService = $reviewService;
    }



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
