<?php

use backend\form\ResourceForm;
use common\models\Resource;
use common\models\Subject;
use common\models\Type;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Resource */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $resource_form ResourceForm */


// default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below)
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css', ['crossorigin' => 'anonymous']);
?>
<div class="resource-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <div class="row">
        <div class="col">
            <?= Html::errorSummary($resource_form) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($resource_form, 'subject_id')->dropdownList(Subject::getList(), [
//                'prompt' => 'Fan yo\'nalishlarini tanglang ...'
            ]) ?>
        </div>
        <div class="col">
            <?= $form->field($resource_form, 'type_id')->dropdownList(Type::getList(), [
//                'prompt' => 'Turini tanlang ...'
            ]) ?>
        </div>
    </div>

    <?= $form->field($resource_form, 'title')->textInput(['maxlength' => true, 'value' => $model->title ?: 'Title has been created at ' . date_format(new DateTime(), 'Y-m-d H:i::s')]) ?>

    <?= $form->field($resource_form, 'description')->textarea(['rows' => 6, 'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda dolores dolorum earum explicabo ipsam laboriosam maxime, minus necessitatibus quam, reprehenderit, tempora. Doloremque impedit laboriosam possimus sit tempora, ut. Earum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda dolores dolorum earum explicabo ipsam laboriosam maxime, minus necessitatibus quam, reprehenderit, tempora. Doloremque impedit laboriosam possimus sit tempora, ut. Earum.']) ?>

    <div class="row">
        <div class="col">
            <?= $form->field($resource_form, 'publisher')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($resource_form, 'date')->widget(DatePicker::class, [
                'options' => ['placeholder' => 'Yaratilgan sanani kiriting ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]) ?>
        </div>
    </div>
    <?= $form->field($resource_form, 'images[]')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'id' => 'images',
            'multiple' => true
        ],
        'pluginOptions' => !empty($model->images) ? [
            'initialPreview' => $model->getImagesUrl(),
            'initialPreviewAsData' => true,
            'initialCaption' => "Caption",
        ] : []
    ]) ?>
    <div class="row">
        <div class="col">
            <?= $form->field($resource_form, 'price')->textInput([
                'type' => 'number',
                'option' => ['step' => '0.01'],
                'class' => 'form-control',
                'placeholder' => 'Enter price ...',
            ])->widget(\yii\widgets\MaskedInput::class,[
                'clientOptions' => [
                    'alias' => 'numeric',
                    'digits' => 2, // Number of decimal places
                    'groupSeparator' => ',', // Thousands separator
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ],
            ])?>
        </div>
        <div class="col">
            <?= $form->field($resource_form, 'count')->textInput([
                'type' => 'number',
                'options' => [
                    'class' => 'form-control', // Specify the CSS class for styling
                    'placeholder' => 'Enter count...',
                    'min' => 1// Placeholder text
                ],
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($resource_form, 'language')->dropDownList(Resource::getLanguageList(), [
//                'prompt' => 'Tilni tanlang'
            ]) ?>
        </div>
    </div>
    <div class="my-41">
        <?= $form->field($resource_form, 'open_access')->checkbox() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCss("
#resourceform-price {
text-align: left !important;
}
");

?>
