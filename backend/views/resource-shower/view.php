<?php

use common\helpers\ResourceShowerHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ResourceShower;
use yii\web\View;

/** @var View $this */
/** @var ResourceShower $model */

$this->title = $model->resource->title;
$this->params['breadcrumbs'][] = ['label' => 'Resource Showers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="resource-shower-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'resource_id',
                'value' => fn($model) => $model->resource->title
            ],
            [
                'attribute' => 'type',
                'value' => fn($model) => ResourceShowerHelper::positionName($model->type)
            ],
        ],
    ]) ?>

</div>
