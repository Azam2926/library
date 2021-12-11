<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ResourceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'publisher') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'open_access') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
