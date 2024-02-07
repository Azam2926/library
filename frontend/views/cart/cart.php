<?php
/* @var $this yii\web\View */
/* @var $cartItems array */
$sumOfItems = 0;
foreach ($cartItems['cartItem'] as $cartItem)
    $sumOfItems += $cartItem['price'] * $cartItem['quantity'];
?>

<div id="top-cart" class="header-misc-icon">
    <a href="#" id="top-cart-trigger"><i class="uil uil-shopping-bag"></i></a>
    <div class="top-cart-content">
        <div class="top-cart-title">
            <h4 class="text-dark">Shopping Cart</h4>
        </div>
        <div class="top-cart-items">
            <?php foreach ($cartItems['cartItem'] as $cartItem): ?>
                <div class="top-cart-item">
                    <div class="top-cart-item-image">
                        <a href="/resource/<?= $cartItem['uuid'] ?>">
                            <img src="<?= $cartItem['url'] ?>" alt="<?= $cartItem['title'] ?>">
                        </a>
                    </div>
                    <div class="top-cart-item-desc">
                        <div class="top-cart-item-desc-title">
                            <a href="/resource/<?= $cartItem['uuid'] ?>" class="fw-normal"><?= $cartItem['title'] ?></a>
                            <span class="top-cart-item-price d-block"><?= $cartItem['price'] ?></span>
                        </div>
                        <div class="top-cart-item-quantity fw-semibold">x <?= $cartItem['quantity'] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="top-cart-action">
            <span class="top-checkout-price fw-semibold text-dark"><?= $sumOfItems ?></span>
            <button class="button button-mini rounded-pill button-border text-dark h-text-color m-0">
                View Cart
            </button>
        </div>
    </div>
</div>
