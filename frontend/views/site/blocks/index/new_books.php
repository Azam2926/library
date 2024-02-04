<?php
/** @var $resources Resource[] */

/** @var $this View */

use common\models\Resource;
use yii\web\View;

?>
<div class="section bg-transparent my-0 my-lg-6">

    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="m-0">Explore the New Collection</h3>
            <a href="#" class="link-dark text-smaller text-uppercase ls-1 fw-medium op-09"><u>Recent Arrivals</u></a>
        </div>
        <div class="row gutter-custom" style="--custom-gutter: 100px">
            <?php foreach ($resources as $resource): ?>
                <div class="col-md-4 text-center">
                    <a href="/resource/<?= $resource->uuid ?>">
                        <img src="<?= $resource->getFirstImageUrlFront() ?>" alt="<?= $resource->title ?>" class="mb-4">
                    </a>
                    <h4 class="mb-2">
                        <a href="/resource/<?= $resource->uuid ?>" class="text-dark"><?= $resource->title ?></a>
                    </h4>
                    <p class="mb-3 small"><?= $resource->price ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>