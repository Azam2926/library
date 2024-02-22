<?php

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model SignupForm */

use frontend\models\SignupForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>
<div class="container">
    <div class="mx-auto mb-0" id="tab-login-register" style="max-width: 500px;">
        <div class="tab-pane active show" id="tab-login" role="tabpanel" aria-labelledby="canvas-tab-login-tab"
             tabindex="0">
            <div class="card mb-0">
                <div class="card-body" style="padding: 40px;">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <div class="row">
                        <div class="col-12 form-group">
                            <?= $form->field($model, 'phone')->textInput() ?>
                        </div>
                        <div class="col-12 form-group">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="col-12 form-group">
                            <?= $form->field($model, 'email') ?>
                        </div>
                        <div class="col-12 form-group">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>
                        <div class="col-12 form-group">
                            <div class="d-flex justify-content-between">
                                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div
    </div>
</div>