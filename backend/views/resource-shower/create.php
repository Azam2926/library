<?php

use yii\helpers\Html;
use backend\form\ResourceShowerCreateForm;
use common\models\ResourceShower;
use  yii\web\View;
use common\models\Resource;

/** @var View $this */
/** @var ResourceShower $model */
/** @var Resource[] $resources */
/** @var ResourceShowerCreateForm $createForm */



$this->title = 'Create Resource Shower';
$this->params['breadcrumbs'][] = ['label' => 'Resource Showers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-shower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'createForm' => $createForm,
        'resources' => $resources,
    ]) ?>

</div>
