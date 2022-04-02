<?php

namespace backend\controllers;

use JetBrains\PhpStorm\ArrayShape;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    #[ArrayShape(['access' => "array"])]
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['resource/*', 'subject/*', 'type/*', 'subject/*', 'site/logout', 'site/index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];

    }
}