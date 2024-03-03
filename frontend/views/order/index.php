<?php

use common\models\UserDetails;
use frontend\dto\CartItemResponseDTO;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/** @var $cartData CartItemResponseDTO */
/** @var $model UserDetails */


$sumOfItems = array_reduce($cartData->getItems(), fn($sum, $item) => $sum + ($item->getQuantity() * $item->getPrice()), 0);

$this->title = 'Order';
?>

<div class="container">
    <div class="row col-mb-50 gutter-50">
        <div class="col-lg-6">
            <h4>Your Orders</h4>
            <div class="table-responsive">
                <table class="table cart">
                    <thead>
                    <tr>
                        <th class="cart-product-thumbnail">&nbsp;</th>
                        <th class="cart-product-name">Product</th>
                        <th class="cart-product-quantity">Quantity</th>
                        <th class="cart-product-subtotal">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cartData->getItems() as $item): ?>
                        <tr class="cart_item">
                            <td class="cart-product-thumbnail">
                                <a href="/resource/<?= $item->getUUID(); ?>">
                                    <img width="64" height="64" src="<?= $item->getUrl() ?>"
                                         alt="<?= $item->getName() ?>">
                                </a>
                            </td>
                            <td class="cart-product-name">
                                <a href="/resource/<?= $item->getUUID(); ?>"><?= $item->getName() ?></a>
                            </td>
                            <td class="cart-product-quantity">
                                <div class="quantity">
                                    <?= $item->getQuantity() ?>
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
        </div>
        <div class="col-lg-6">
            <h4>Cart Totals</h4>
            <div class="table-responsive">
                <table class="table cart">
                    <tbody>
                    <tr class="cart_item">
                        <td class="border-top-0 cart-product-name">
                            <strong>Cart Subtotal</strong>
                        </td>
                        <td class="border-top-0 cart-product-name">
                            <span class="amount"><?= $sumOfItems ?></span>
                        </td>
                    </tr>
                    <tr class="cart_item">
                        <td class="cart-product-name">
                            <strong>Shipping</strong>
                        </td>
                        <td class="cart-product-name">
                            <span class="amount">Free Delivery</span>
                        </td>
                    </tr>
                    <tr class="cart_item">
                        <td class="cart-product-name">
                            <strong>Total</strong>
                        </td>
                        <td class="cart-product-name">
                            <span class="amount color lead"><strong><?= $sumOfItems ?></strong></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6 offset-lg-3">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'firstname') ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'lastname') ?>
                </div>
            </div>
            <?= $form->field($model, 'full_address') ?>
            <?= $form->field($model, 'description')->textarea() ?>

            <div class="form-group">
                <?= Html::submitButton('Place Order', ['class' => 'button button-3d']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
