<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ResourceShower $model */
/** @var common\models\Resource[] $resources */
/** @var \backend\form\ResourceShowerForm $createForm */
/** @var common\helpers\ResourceShowerHelper $positionList */



$this->title = 'Create Resource Shower';
$this->params['breadcrumbs'][] = ['label' => 'Resource Showers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-shower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'createForm' => $createForm,
        'resources' => $resources,
//        'positionList' => $positionList
    ]) ?>

</div>
