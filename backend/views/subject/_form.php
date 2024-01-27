<?php

use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subject */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::className(),
        [
            'data' => $parentSubjectList,
            'options' => [
                'prompt' => 'Select Parent Subject',
                'required' => false,
                'value' => $model->parent_id,
            ]
        ])->label(Yii::t('yii', 'Select Parent Subject')); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
