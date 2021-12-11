<?php

use frontend\models\ResourceFilter;
use yii\bootstrap5\Accordion;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

/* @var $this View */
/* @var $filterModel ResourceFilter */

$this->registerJs(<<<JS
const titlePublisher = $('#title_publisher')
const resourceFilterTitlePublisher = $('#resourcefilter-title_publisher')

$('#title_publisher-trigger').on('click', e => doEqual(e))
titlePublisher.on('change', e => doEqual(e))
titlePublisher.on('keydown', e => e.keyCode === 13 ? doEqual(e) : undefined)

function doEqual (e) {
  e.preventDefault()
  resourceFilterTitlePublisher.val(titlePublisher.val())
  return resourceFilterTitlePublisher.trigger('change')
}
JS, 3)
?>


<div class="d-flex my-3 p-2 px-3 justify-content-between rounded" style="background-color: #ededed">
    <div class="d-flex align-items-center">
        <i class="far fa-sliders-v fs-5 me-2"></i>
        <strong>Filtrlar</strong>
    </div>
    <div>
        <?= Html::a('Tozalash', ['resources'], ['onclick' => "$('#resource-filter').trigger('reset')", 'style' => '']) ?>
    </div>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'resource-filter',
    'action' => ['resources'],
    'method' => 'get',
    'options' => ['data' => ['pjax' => true], 'class' => 'py-3'],
    'fieldConfig' => ['options' => ['onchange' => "$('#resource-filter').submit()"]],
    'enableClientValidation' => false,
]) ?>
<?= $form->field($filterModel, 'title_publisher')->hiddenInput()->label(false) ?>


<?= Accordion::widget([
    'itemToggleOptions' => ['class' => 'fs-5 text-black'],
    'items' => [
        [
            'label' => $filterModel->getAttributeLabel('subjects'),
            'content' => $form->field($filterModel, 'subjects')->checkboxList($filterModel->getSubjectList())->label(false),
            'expand' => true,
            'contentOptions' => ['data-bs-parent' => ''],
        ],
        [
            'label' => $filterModel->getAttributeLabel('types'),
            'content' => $form->field($filterModel, 'types')->checkboxList($filterModel->getTypeList())->label(false),
            'expand' => true,
            'contentOptions' => ['data-bs-parent' => ''],
        ],
        [
            'label' => $filterModel->getAttributeLabel('languages'),
            'content' => $form->field($filterModel, 'languages')->checkboxList($filterModel->languageList)->label(false),
            'expand' => true,
            'contentOptions' => ['data-bs-parent' => ''],
        ],
        [
            'label' => $filterModel->getAttributeLabel('access'),
            'content' => $form->field($filterModel, 'access')->radioList($filterModel->accessList)->label(false),
            'expand' => true,
            'contentOptions' => ['data-bs-parent' => ''],
        ],
    ]
]);
?>

<?php ActiveForm::end() ?>
