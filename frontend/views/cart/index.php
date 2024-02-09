<?php

use common\models\Resource;
use frontend\components\Stats;
use frontend\dto\CartItemResponseDTO;

/* @var $this yii\web\View */
/** @var $new_resources Resource[] */
/** @var $new_electron_resources Resource[] */
/** @var $new_audio_resources Resource[] */
/** @var $new_video_resources Resource[] */
/** @var $statistics Stats */
/** @var $model CartItemResponseDTO */

$this->title = 'User cart';
$this->registerJs(<<<JS
    console.log("Cart")
JS
);
?>

<div class="container">
    <table class="table cart mb-5">
        <thead>
        <tr>
            <th class="cart-product-remove">&nbsp;</th>
            <th class="cart-product-thumbnail">&nbsp;</th>
            <th class="cart-product-name">Product</th>
            <th class="cart-product-price">Unit Price</th>
            <th class="cart-product-quantity">Quantity</th>
            <th class="cart-product-subtotal">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->getItems() as $item): ?>
            <tr class="cart_item">
                <td class="cart-product-remove">
                    <a href="#" class="remove" title="Remove this item"><i class="fa-solid fa-trash"></i></a>
                </td>

                <td class="cart-product-thumbnail">
                    <a href="#">
                        <img width="64" height="64" src="<?= $item->getUrl() ?>" alt="<?= $item->getName() ?>">
                    </a>
                </td>

                <td class="cart-product-name">
                    <a href="#"><?= $item->getName() ?></a>
                </td>

                <td class="cart-product-price">
                    <span class="amount"><?= $item->getPrice() ?></span>
                </td>

                <td class="cart-product-quantity">
                    <div class="quantity">
                        <input type="button" value="-" class="minus">
                        <input type="text" name="quantity" value="<?= $item->getQuantity() ?>" class="qty">
                        <input type="button" value="+" class="plus">
                    </div>
                </td>

                <td class="cart-product-subtotal">
                    <span class="amount"><?= $item->getQuantity() * $item->getPrice() ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>