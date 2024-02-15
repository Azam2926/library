<?php

use frontend\dto\CartItemResponseDTO;

/* @var $this yii\web\View */
/** @var $model CartItemResponseDTO */

$sumOfItems = array_reduce($model->getItems(), fn($sum, $item) => $sum + ($item->getQuantity() * $item->getPrice()), 0);

$this->title = 'Order';
?>

<div class="container">
    <div class="row col-mb-50 gutter-50">
        <div class="col-lg-6">
            <h3>Billing Address</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, vel odio non dicta provident sint ex
                autem mollitia dolorem illum repellat ipsum aliquid illo similique sapiente fugiat minus ratione.</p>
            <form id="billing-form" name="billing-form" class="row mb-0" action="#" method="post">
                <div class="col-md-6 form-group">
                    <label for="billing-form-name">Name:</label>
                    <input type="text" id="billing-form-name" name="billing-form-name" value="" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="billing-form-lname">Last Name:</label>
                    <input type="text" id="billing-form-lname" name="billing-form-lname" value="" class="form-control">
                </div>
                <div class="w-100"></div>
                <div class="col-12 form-group">
                    <label for="billing-form-companyname">Company Name:</label>
                    <input type="text" id="billing-form-companyname" name="billing-form-companyname" value=""
                           class="form-control">
                </div>
                <div class="col-12 form-group">
                    <label for="billing-form-address">Address:</label>
                    <input type="text" id="billing-form-address" name="billing-form-address" value=""
                           class="form-control">
                </div>
                <div class="col-12 form-group">
                    <input type="text" id="billing-form-address2" name="billing-form-adress" value=""
                           class="form-control">
                </div>
                <div class="col-12 form-group">
                    <label for="billing-form-city">City / Town</label>
                    <input type="text" id="billing-form-city" name="billing-form-city" value="" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="billing-form-email">Email Address:</label>
                    <input type="email" id="billing-form-email" name="billing-form-email" value="" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="billing-form-phone">Phone:</label>
                    <input type="text" id="billing-form-phone" name="billing-form-phone" value="" class="form-control">
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <h3>Shipping Address</h3>
            <form id="shipping-form" name="shipping-form" class="row mb-0" action="#" method="post">
                <div class="col-md-6 form-group">
                    <label for="shipping-form-name">Name:</label>
                    <input type="text" id="shipping-form-name" name="shipping-form-name" value="" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="shipping-form-lname">Last Name:</label>
                    <input type="text" id="shipping-form-lname" name="shipping-form-lname" value=""
                           class="form-control">
                </div>
                <div class="w-100"></div>
                <div class="col-12 form-group">
                    <label for="shipping-form-companyname">Company Name:</label>
                    <input type="text" id="shipping-form-companyname" name="shipping-form-companyname" value=""
                           class="form-control">
                </div>
                <div class="col-12 form-group">
                    <label for="shipping-form-address">Address:</label>
                    <input type="text" id="shipping-form-address" name="shipping-form-address" value=""
                           class="form-control">
                </div>
                <div class="col-12 form-group">
                    <input type="text" id="shipping-form-address2" name="shipping-form-adress" value=""
                           class="form-control">
                </div>
                <div class="col-12 form-group">
                    <label for="shipping-form-city">City / Town</label>
                    <input type="text" id="shipping-form-city" name="shipping-form-city" value="" class="form-control">
                </div>
                <div class="col-12 form-group">
                    <label for="shipping-form-message">Notes <small>*</small></label>
                    <textarea class="form-control" id="shipping-form-message" name="shipping-form-message" rows="6"
                              cols="30"></textarea>
                </div>
            </form>
        </div>
        <div class="w-100"></div>
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
                    <?php foreach ($model->getItems() as $item): ?>
                        <tr class="cart_item">
                            <td class="cart-product-thumbnail">
                                <a href="/resource/<?= $item->getUUID(); ?>">
                                    <img width="64" height="64" src="<?= $item->getUrl() ?>" alt="<?= $item->getName() ?>">
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
            <div class="accordion">
                <div class="accordion-header accordion-active">
                    <div class="accordion-icon">
                        <i class="accordion-closed uil uil-minus"></i>
                        <i class="accordion-open bi-check-lg"></i>
                    </div>
                    <div class="accordion-title">
                        Direct Bank Transfer
                    </div>
                </div>
                <div class="accordion-content" style="display: block;">Donec sed odio dui. Nulla vitae elit libero, a
                    pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante
                    venenatis dapibus posuere velit aliquet.
                </div>
                <div class="accordion-header">
                    <div class="accordion-icon">
                        <i class="accordion-closed uil uil-minus"></i>
                        <i class="accordion-open bi-check-lg"></i>
                    </div>
                    <div class="accordion-title">
                        Cheque Payment
                    </div>
                </div>
                <div class="accordion-content" style="display: none;">Integer posuere erat a ante venenatis dapibus
                    posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed
                    consectetur. Cras mattis consectetur purus sit amet fermentum.
                </div>
                <div class="accordion-header">
                    <div class="accordion-icon">
                        <i class="accordion-closed uil uil-minus"></i>
                        <i class="accordion-open bi-check-lg"></i>
                    </div>
                    <div class="accordion-title">
                        Paypal
                    </div>
                </div>
                <div class="accordion-content" style="display: none;">Nullam id dolor id nibh ultricies vehicula ut id
                    elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non
                    commodo luctus. Aenean lacinia bibendum nulla sed consectetur.
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="#" class="button button-3d">Place Order</a>
            </div>
        </div>
    </div>
</div>
