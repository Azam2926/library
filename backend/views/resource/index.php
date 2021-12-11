<?php

use common\models\Resource;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ResourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Resource', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'subject_id',
                'value' => fn($model) => $model->subject->name
            ],
            [
                'attribute' => 'type_id',
                'value' => fn($model) => $model->types->name
            ],
            'title',
            //'description:ntext',
            //'publisher',
            //'date',
            [
                'attribute' => 'language',
                'value' => fn($model) => Resource::getLanguageList()[$model->language]
            ],
            [
                'attribute' => 'type',
                'value' => fn($model) => Resource::getTypeList()[$model->type]
            ],
            //'open_access',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
