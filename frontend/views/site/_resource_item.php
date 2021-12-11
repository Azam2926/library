<?php

use common\models\Resource;
use yii\helpers\StringHelper;
use yii\web\View;

/* @var $this View */
/* @var $model Resource */
?>
<div class="card shadow">
    <?= $model->showAccess() ?>
    <img style="border-radius: unset" src="<?= $model->getUploadedFileUrlFromFrontend('thumbnail') ?>" height="270" class="card-img-top" alt="<?= $model->title ?>">
    <div class="card-body">
        <div class="d-flex flex-column justify-content-between" style="min-height: 89px">
            <a href="/resource/<?= $model->uuid ?>">
                <h5 class="card-title fw-bold" title="<?= $model->title ?>" style="word-break: break-word; font-size: 16px">
                    <?= StringHelper::truncate($model->title, Resource::TRUNCATE_TEXT_NUMBER) ?>
                </h5>
            </a>
            <p class="m-0"><?= $model->publisher ?></p>
        </div>
        <p class="card-text"><?= $model->showType() ?></p>
        <a href="/resource/<?= $model->uuid ?>" class="d-block btn bg-primary-color text-white">Batafsil</a>
    </div>
</div>
