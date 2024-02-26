<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */

/* @var $model LoginForm */

use common\models\LoginForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="mx-auto mb-0" id="tab-login-register" style="max-width: 500px;">
        <div class="tab-pane active show" id="tab-login" role="tabpanel" aria-labelledby="canvas-tab-login-tab"
             tabindex="0">
            <div class="card mb-0">
                <div class="card-body" style="padding: 40px;">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => [
                        'name' => 'login-form',
                        'class' => 'mb-0'
                    ]]); ?>

                    <h3>Login to your Account</h3>
                    <div class="row">
                        <div class="col-12 form-group">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="col-12 form-group">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>
                        <div class="col-12 form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <?= Html::submitButton('Login', ['class' => 'button button-3d button-black m-0', 'name' => 'login-form-submit']) ?>
                                <a href="/site/signup">or signup first</a>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div
    </div>
</div>