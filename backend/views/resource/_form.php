<?php

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


// default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below)
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css', ['crossorigin' => 'anonymous']);

$this->registerJs(<<<JS
function initFileFields() {
    $(".field-textandaudio").fadeOut('slow')
    $(".field-youtubevideo").fadeOut('slow')
}

$("#resource-type").on('change',function(e){
  
       switch (e.target.value) {
         case '0':
         case '1':
            $(".field-textandaudio").fadeIn('slow')
            $(".field-textandaudio").parent().css('visibility', 'initial')
            $(".field-youtubevideo").fadeOut('slow')
            $(".field-youtubevideo").parent().css('visibility', 'collapse')
            $(".field-youtubevideo").parent().parent().css('min-height', '400px')

            break
        case '2':
            $(".field-textandaudio").fadeOut('slow')
            $(".field-textandaudio").parent().css('visibility', 'collapse')
            $(".field-youtubevideo").fadeIn('slow')
            $(".field-youtubevideo").parent().css('visibility', 'initial')
            $(".field-youtubevideo").parent().parent().css('min-height', '80px')
            break
        default:
            initFileFields()
       }
});
$("#resource-type").trigger('change')

JS, yii\web\View::POS_LOAD)
?>
<div class="resource-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <div class="row">
        <div class="col">
            <?= Html::errorSummary($model) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'subject_id')->dropdownList(Subject::getList(), [
//                'prompt' => 'Fan yo\'nalishlarini tanglang ...'
            ]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'type_id')->dropdownList(Type::getList(), [
//                'prompt' => 'Turini tanlang ...'
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'value' => 'Title has been created at ' . date_format(new DateTime(), 'Y-m-d H:i::s')]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda dolores dolorum earum explicabo ipsam laboriosam maxime, minus necessitatibus quam, reprehenderit, tempora. Doloremque impedit laboriosam possimus sit tempora, ut. Earum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda dolores dolorum earum explicabo ipsam laboriosam maxime, minus necessitatibus quam, reprehenderit, tempora. Doloremque impedit laboriosam possimus sit tempora, ut. Earum.']) ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'date')->widget(DatePicker::class, [
                'options' => ['placeholder' => 'Yaratilgan sanani kiriting ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]) ?>
        </div>
    </div>
    <?= $form->field($model, 'thumbnail')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'id' => 'thumbnail',
        ],
        'pluginOptions' => $model->thumbnail ? [
            'initialPreview' => [
                $model->getUploadedFileUrl('thumbnail')
            ],
            'initialPreviewAsData' => true,
            'initialCaption' => $model->thumbnail,
        ] : []
    ]) ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'language')->dropDownList(Resource::getLanguageList(), [
//                'prompt' => 'Tilni tanlang'
            ]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'type')->dropdownList(Resource::getTypeList(), [
//                'prompt' => 'Tipni tanlang'
            ]) ?>
        </div>
    </div>
    <div class="my-41">
        <?= $form->field($model, 'open_access')->checkbox() ?>
    </div>

    <div class="row" style="transition: min-height 0.25s ease-in">
        <div class="col">
            <?= $form->field($model, 'file')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'audio/mp3, .pdf',
                    'id' => 'textandaudio',
                    'multiple' => false
                ],
                'pluginOptions' => $model->type != Resource::TYPE_YOUTUBEVIDEO ? [
                    'initialPreview' => [
                        $model->getUploadedFileUrl('file')
                    ],
                    'initialPreviewAsData' => true,
                    'initialCaption' => $model->file,
                    'allowedFileTypes' => ["image", "audio", 'pdf'],
                ] : []
            ])->label('Audio Or Book'); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'youtubelink')->textInput(['maxlength' => true, 'id' => 'youtubevideo'])->label('Youtube Link') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
