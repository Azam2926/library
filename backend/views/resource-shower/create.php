<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ResourceShower $model */

$this->title = 'Create Resource Shower';
$this->params['breadcrumbs'][] = ['label' => 'Resource Showers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-shower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
