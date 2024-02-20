<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\base\Exception;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionIndex()
    {
        $user = new User();
        $user->username = 'webmaster';
        $user->email = 'webmaster@mail.uz';
        $user->password_hash = Yii::$app->security->generatePasswordHash('webm@ster123');
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->save();
    }
}