<?php

use yii\helpers\Html;
use yii\web\View;
use common\models\Resource;
use backend\form\ResourceForm;

/* @var $this View */
/* @var $model Resource */
/* @var $updateForm ResourceForm */


$this->title = 'Update Resource: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resource-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'resource_form' => $updateForm
    ]) ?>

</div>
