<?php

use common\models\Resource;
use yii\web\View;

/* @var $this View */
/* @var $model Resource */
?>
<div class="grid-inner">
    <div class="product-image">
        <?php foreach ($model->images as $image): ?>
            <a href="<?= $model->getUrl() ?>">
                <img src="<?= $image->getUploadedFileUrlFromFrontend() ?>"
                     alt="<?= $image->name ?>">
            </a>
        <?php endforeach; ?>
        <div class="sale-flash badge bg-secondary p-2">Out of Stock</div>
        <div class="bg-overlay">
            <div class="bg-overlay-content align-items-end justify-content-center p-0">
                <a href="include/ajax/shop-item.html"
                   class="btn btn-light py-2 w-100 m-0 rounded-0 animated fadeOutDown" data-lightbox="ajax"
                   data-hover-animate="fadeInUp" data-hover-animate-out="fadeOutDown" data-hover-speed="400"
                   data-hover-parent=".product" style="animation-duration: 400ms;">Quick View</a>
            </div>
            <div class="bg-overlay-bg bg-transparent"></div>
        </div>
    </div>
    <div class="product-desc text-center">
        <div class="product-title"><h3><a href="<?= $model->getUrl() ?>"><?= $model->title ?></a></h3></div>
        <div class="product-price">
            <?= $model->price ?>
        </div>
        <a href="#" class="btn btn-sm btn-dark px-3 mt-2"><i class="uil uil-shopping-cart me-1"></i> Add to Cart</a>
    </div>
</div>
