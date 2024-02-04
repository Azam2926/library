<?php

use common\models\Resource;
use yii\helpers\StringHelper;
use yii\web\View;

/* @var $this View */
/* @var $model Resource */
?>

<div class="grid-inner">
    <div class="product-image">
        <a href="/resource/<?= $model->uuid ?>"><img src="images/shop/dress/1s.jpg" alt="<?= $model->title ?>"></a>
        <a href="/resource/<?= $model->uuid ?>"><img src="images/shop/dress/1-1.jpg" alt="<?= $model->title ?>"></a>
        <?= $model->inStock() ?>
        <div class="bg-overlay">
            <div class="bg-overlay-content align-items-end justify-content-center p-0">
                <a href="include/ajax/shop-item.html" class="btn btn-light py-2 w-100 m-0 rounded-0"
                   data-lightbox="ajax" data-hover-animate="fadeInUp" data-hover-animate-out="fadeOutDown"
                   data-hover-speed="400" data-hover-parent=".product">Quick View</a>
            </div>
            <div class="bg-overlay-bg bg-transparent"></div>
        </div>
    </div
    <div class="product-desc text-center">
        <div class="product-title">
            <h3>
                <a href="/resource/<?= $model->uuid ?>">
                    <?= StringHelper::truncate($model->title, Resource::TRUNCATE_TEXT_NUMBER) ?>
                </a>
            </h3>
        </div>
        <div class="product-price"><?= $model->price ?>
        </div>
        <a href="#" class="btn btn-sm btn-dark px-3 mt-2"><i class="uil uil-shopping-cart me-1"></i> Add to Cart</a>
    </div>
</div>