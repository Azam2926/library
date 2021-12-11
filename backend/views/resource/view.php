<?php

use common\models\Resource;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Resource */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="resource-view">
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

    <?= $model->showThumbnail() ?>
    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'uuid',
                    [
                        'attribute' => 'subject_id',
                        'value' => $model->subject->name
                    ],
                    [
                        'attribute' => 'type_id',
                        'value' => $model->types->name
                    ],
                    'title',
                    'description:ntext',
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'publisher',
                    'date',
                    [
                        'attribute' => 'language',
                        'value' => Resource::getLanguageList()[$model->language]
                    ],
                    [
                        'attribute' => 'type',
                        'value' => Resource::getTypeList()[$model->type]
                    ],
                    [
                        'attribute' => 'file',
                        'format' => 'html',
                        'value' => $model->showFile()
                    ],
                    'open_access:boolean',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>


</div>
