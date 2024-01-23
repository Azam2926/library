<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ResourceShower $model */

$this->title = 'Update Resource Shower: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Resource Showers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resource-shower-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
