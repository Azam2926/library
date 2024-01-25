<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use common\models\ResourceShower;
use backend\form\ResourceShowerCreateForm;
use common\helpers\ResourceShowerHelper;

/** @var View $this */
/** @var ResourceShower $model */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Resource[] $resources */
/** @var ResourceShowerCreateForm $createForm */

?>

<div class="resource-shower-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($createForm, 'id')->hiddenInput(['value' => $model->id])->label(false); ?>

    <?= $form->field($createForm, 'type')->widget(Select2::className(),
        [
            'data' => ResourceShowerHelper::positionList(),
            'options' => [
                'prompt' => 'Select Position',
                'required' => 'required',
                'value' => $model->type,
            ]
        ])->label(Yii::t('yii', 'Position')); ?>

    <?= $form->field($createForm, 'resource_id')->widget(Select2::classname(),
        [
            'data' => $resources,
            'options' => [
                'placeholder' => Yii::t('app', 'Select Resources'),
                'required' => 'required',
                'value' => $model->resource_id,
            ],
            'pluginOptions' => ['multiple' => true],
        ])->label(Yii::t('yii', 'Resources')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
