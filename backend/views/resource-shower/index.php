<?php

use common\models\ResourceShower;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\helpers\ResourceShowerHelper;
use backend\models\ResourceShowerSearch;
use yii\web\View;
use yii\data\ActiveDataProvider;

/** @var View $this */
/** @var ResourceShowerSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = 'Resource Showers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-shower-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Resource Shower', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'resource_id',
                'value' => fn($model) => $model->resource->title
            ],
            [
                'attribute' => 'type',
                'value' => fn($model) => ResourceShowerHelper::positionName($model->type)
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ResourceShower $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
