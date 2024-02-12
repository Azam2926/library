<?php
/* @var $this yii\web\View */
/* @var $cartItems array */

use yii\helpers\Url;

$cartItems = $cartItems['cartItem'] ?? [];
$sumOfItems = array_reduce($cartItems, fn($sum, $cartItem) => $sum + ($cartItem['price'] * $cartItem['quantity']), 0);
$count = count($cartItems);


$this->registerJs(<<<JS
document.getElementById('top-cart-trigger').onclick = function(e) {
    e.stopPropagation();
    e.preventDefault();

    $('#top-cart').toggleClass('top-cart-open');
};

document.addEventListener('click', function(e) {
    if( !e.target.closest('#top-cart') ) {
        $('#top-cart').removeClass('top-cart-open');
    }
}, false);
JS
);
?>

<div id="top-cart" class="header-misc-icon">
    <a href="#" id="top-cart-trigger">
        <i class="uil uil-shopping-bag"></i>
        <span class="top-cart-number">
            <?= $count ?>
        </span>
        <span class="top-cart-number"><?= $count ?></span></a>
    <div class="top-cart-content">
        <?php if (Yii::$app->user->isGuest): ?>
            <div class="top-cart-title">
                <h4 class="text-dark">
                    <a href="/site/login">Login</a> to see cart
                </h4>
            </div>
        <?php else: ?>

            <div class="top-cart-title">
                <h4 class="text-dark">Shopping Cart</h4>
            </div>
            <div class="top-cart-items">
                <?php foreach ($cartItems as $cartItem): ?>
                    <?= $this->render('_cart_item', ['item' => $cartItem]) ?>
                <?php endforeach; ?>
            </div>
            <div class="top-cart-action">
                <span class="top-checkout-price fw-semibold text-dark"><?= $sumOfItems . " UZS" ?></span>
                <a href="<?= Url::to(['cart/index']) ?>" class="button button-mini rounded-pill button-border text-dark h-text-color m-0">
                    View Cart
                </a>
            </div>
            </div>

        <?php endif; ?>
    </div>
</div>
