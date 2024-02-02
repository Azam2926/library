<?php

use common\models\Resource;
use yii\helpers\StringHelper;
use yii\web\View;

/* @var $this View */
/* @var $model Resource */
?>
<div class="card shadow">
    <?= $model->showAccess() ?>
    <a href="/resource/<?= $model->uuid ?>">
        <img title="<?= $model->title ?>" style="border-radius: unset" src="<?= $model->getUploadedFileUrlFromFrontend('thumbnail') ?>" height="270" class="card-img-top"
             alt="<?= $model->title ?>">
    </a>
    <div class="card-body">
        <div class="d-flex flex-column justify-content-between" style="min-height: 70px;">
            <a href="/resource/<?= $model->uuid ?>">
                <h5 class="card-title fw-bold" title="<?= $model->title ?>" style="word-break: break-word; font-size: 14px">
                    <?= StringHelper::truncate($model->title, Resource::TRUNCATE_TEXT_NUMBER) ?>
                </h5>
            </a>
        </div>
        <p class="mb-1" style="min-height: 40px; font-size: 13px"><?= $model->getFirstTwoPublisher() ?></p>
        <p class="card-text"></p>
        <a href="/resource/<?= $model->uuid ?>" class="d-block btn bg-primary-color text-white">Batafsil</a>
    </div>
</div>
