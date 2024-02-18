<?php

use yii\bootstrap5\LinkPager;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\LinkSorter;
use yii\widgets\ListView;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */
?>

<?= ListView::widget([
    'id' => 'resources-list',
    'layout' => <<<HTML
<div class="d-flex justify-content-between align-items-center py-3 mb-3" >
    <div>{summary}</div>
    <div>{sorter}</div>
</div>
{items}
{pager}
HTML,
    'dataProvider' => $dataProvider,
    'itemView' => '_resource_item',
    'options' => ['class' => 'row'],
    'itemOptions' => ['class' => 'product col-md-4 col-sm-6 col-12 mb-4'],
    'pager' => ['class' => LinkPager::class],
    'sorter' => [
        'class' => LinkSorter::class,
        'options' => [
            'class' => 'list-group list-group-horizontal list-group-flush',
            'style' => ['list-style' => 'none']
        ],
        'linkOptions' => [
            'class' => 'list-group-item'
        ]
    ]
]) ?>
