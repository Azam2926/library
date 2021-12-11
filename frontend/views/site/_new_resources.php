<?php
/** @var $title string */
/** @var $resources Resource[] */

/** @var $this View */

use common\models\Resource;
use yii\web\View;

//dump($resources);
?>

<h1 class="text-center mb-5 fw-bolder"><?= $title ?></h1>
<div class="row px-sm-5 justify-content-center">
    <?php foreach ($resources as $resource): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 px-1 mb-5" style="max-width: 220px">
            <?= $this->render('_resource_item', ['model' => $resource]) ?>
        </div>
    <?php endforeach; ?>
</div>

