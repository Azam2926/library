<?php
/* @var $item array */
?>

<div class="top-cart-item">
    <div class="top-cart-item-image">
        <a href="/resource/<?= $item['uuid'] ?>">
            <img src="<?= $item['url'] ?>" alt="<?= $item['title'] ?>">
        </a>
    </div>
    <div class="top-cart-item-desc">
        <div class="top-cart-item-desc-title">
            <a href="/resource/<?= $item['uuid'] ?>" class="fw-normal"><?= $item['title'] ?></a>
            <span class="top-cart-item-price d-block"><?= $item['price'] ?></span>
        </div>
        <div class="top-cart-item-quantity fw-semibold">x <?= $item['quantity'] ?></div>
    </div>
</div>
