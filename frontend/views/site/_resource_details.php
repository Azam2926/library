<?php

/* @var $this View */

/* @var $resource Resource */

use common\models\Resource;
use yii\web\View;

?>
<div class="row">

    <div class="col-md-3">
        <strong><?= $resource->getAttributeLabel('title') ?></strong>
    </div>
    <div class="col-md-9">
        <span><?= $resource->title ?></span>
    </div>

    <div class="col-md-3">
        <strong><?= $resource->getAttributeLabel('description') ?></strong>
    </div>
    <div class="col-md-9">
        <span><?= $resource->description ?></span>
    </div>

    <div class="col-md-3">
        <strong><?= $resource->getAttributeLabel('publisher') ?></strong>
    </div>
    <div class="col-md-9">
        <span><?= $resource->publisher ?></span>
    </div>

    <div class="col-md-3">
        <strong><?= $resource->getAttributeLabel('date') ?></strong>
    </div>
    <div class="col-md-9">
        <span><?= $resource->getYearFromDate() ?></span>
    </div>

    <div class="col-md-3">
        <strong><?= $resource->getAttributeLabel('subject_id') ?></strong>
    </div>
    <div class="col-md-9">
        <span><?= $resource->subject->name ?></span>
    </div>

    <div class="col-md-3">
        <strong><?= $resource->getAttributeLabel('language') ?></strong>
    </div>
    <div class="col-md-9">
        <span><?= $resource->showLanguage() ?></span>
    </div>

    <div class="col-md-3">
        <strong><?= $resource->getAttributeLabel('type') ?></strong>
    </div>
    <div class="col-md-9">
        <span><?= Resource::getTypeList()[$resource->type] ?></span>
    </div>

</div>

