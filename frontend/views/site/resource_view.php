<?php
/** @var Resource $resource */

/** @var View $this */

use common\models\Resource;
use frontend\widgets\ResourceViewsAndDownloads;
use yii\bootstrap5\Tabs;
use yii\web\View;

?>

<div class="resource-view">
    <div class="container mx-auto">
        <div class="row mt-5">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <img class="rounded img-fluid" src="<?= $resource->getUploadedFileUrlFromFrontend('thumbnail') ?>" alt="thumbnail">

                <?= ResourceViewsAndDownloads::widget([
                    'resource' => $resource
                ]) ?>

            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-6 mb-3">
                <h3><?= $resource->title ?></h3>
                <p><?= $resource->publisher ?></p>
                <p><?= $resource->getYearFromDate() ?></p>
                <p><?= $resource->showType() ?></p>
                <?= Tabs::widget([
                    'id' => 'resource_view-tab',
                    'options' => ['class' => 'mt-3 mt-md-5'],
                    'itemOptions' => ['class' => 'mt-1 mt-md-2'],
                    'items' => [
                        [
                            'label' => 'Tavsifi',
                            'content' => $resource->description,
                        ],
                        [
                            'label' => 'Batafsil',
                            'content' => $this->render('_resource_details', ['resource' => $resource]),
                        ]
                    ],
                ]); ?>
            </div>
            <div class="col-12 col-sm-6 col-md-12 col-lg-3 border-top pt-3">
                <div class="mb-2">
                    <strong><?= $resource->getAttributeLabel('open_access') ?></strong>
                    <p><?= $resource->showAccess() ?></p>
                </div>

                <div class="mb-2">
                    <strong><?= $resource->getAttributeLabel('format') ?></strong>
                    <p><?= $resource->format ?></p>
                </div>

                <div class="mb-2">
                    <strong><?= $resource->getAttributeLabel('language') ?></strong>
                    <p><?= $resource->showLanguage() ?></p>
                </div>

                <?php if ($resource->type != Resource::TYPE_YOUTUBEVIDEO): ?>
                    <div class="mb-2">
                        <strong><?= $resource->getAttributeLabel('size') ?></strong>
                        <p><?= $resource->size ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>