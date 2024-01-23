<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ResourceShower $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="resource-shower-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resource_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
