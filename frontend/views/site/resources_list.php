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
    'itemOptions' => ['class' => 'col-lg-4 col-xl-3 col-6 px-1 mb-4'],
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
