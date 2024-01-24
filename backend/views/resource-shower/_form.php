<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use common\models\ResourceShower;
use backend\form\ResourceShowerForm;
use common\helpers\ResourceShowerHelper;

/** @var View $this */
/** @var ResourceShower $model */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Resource[] $resources */
/** @var ResourceShowerForm $createForm */
/** @var ResourceShowerHelper $positionList */

//dd($createForm);
?>

<div class="resource-shower-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($createForm, 'type')->widget(Select2::className(),
        [
            'data' => ResourceShowerHelper::$array,
            'options' => [
                'prompt' => 'Select Position',
                'required' => 'required',
            ]
        ])->label(Yii::t('yii', 'Position')); ?>

    <?= $form->field($createForm, 'resource_id')->widget(Select2::classname(),
        [
            'data' => $resources,
            'options' => [
                'placeholder' => Yii::t('app', 'Select Resources'),
                'required' => 'required',
            ],
            'pluginOptions' => ['multiple' => true],
        ])->label(Yii::t('yii', 'Resources')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
