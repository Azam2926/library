<?php
/** @var $title string */
/** @var $resources Resource[] */

/** @var $this View */

use common\models\Resource;
use yii\web\View;

?>

<h1 class="text-center mb-5 fw-bolder"><?= $title ?></h1>
<div class="shop row gutter-30">
    <?php foreach ($resources as $resource): ?>
        <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
            <?= $this->render('blocks/resource/resource_item', ['model' => $resource]) ?>
        </div>
    <?php endforeach; ?>
</div>

