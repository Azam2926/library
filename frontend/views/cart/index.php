<?php

use common\models\Resource;
use frontend\components\Stats;
use frontend\dto\CartItemResponseDTO;
use yii\helpers\Url;

/* @var $this yii\web\View */
/** @var $new_resources Resource[] */
/** @var $new_electron_resources Resource[] */
/** @var $new_audio_resources Resource[] */
/** @var $new_video_resources Resource[] */
/** @var $statistics Stats */
/** @var $model CartItemResponseDTO */

$this->title = 'User cart';
$this->registerJs(<<<JS
$(document).ready(function (){
    
    $('.check').click(function (){
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var uuid = $(this).closest('.quantity').find('#resource_uuid').val();
        var quantity = $("#qty-"+uuid).val();
        var amount = $("#amount-"+uuid).text();
        
       
        $.post('/cart/change-cart-quantity', {uuid: uuid, qty: quantity, '_csrf-frontend': csrfToken})
        .done(function (response){
            if(response==true){
                var total = amount * quantity;
                $('#total-'+uuid).text(total);
                updateTopCard()
            }
            else{
                alert("test");
            }
        })
        .fail(e => {
               alert(e.status);
            })
    })
    
    $('.remove').click(function (){
         var uuid = $(this).closest('.cart_item').find('#resource_uuid').val();
         var csrfToken = $('meta[name="csrf-token"]').attr("content");
         
         $.post('/cart/remove-cart', {uuid: uuid, '_csrf-frontend': csrfToken})
         .done(function (response){
            if(response==true){
                $("#uuid-"+uuid).remove();
                updateTopCard()
            }
            else{
                alert("false or some error");
            }
         })
        .fail(e => {
               alert(e.status);
        })
    })
})
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
            <tr class="cart_item" id="uuid-<?= $item->getUUID() ?>">
                <td class="cart-product-remove">
                    <a href="javascript:void(0);" class="remove" title="Remove this item"><i class="fa-solid fa-trash"></i></a>
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
                    <span class="amount" id="amount-<?= $item->getUUID(); ?>"><?= $item->getPrice() ?></span>
                </td>

                <td class="cart-product-quantity">
                    <div class="quantity">
                        <input type="hidden" name="resource_uuid" id="resource_uuid" value="<?= $item->getUUID(); ?>">
                        <input type="button" value="-" class="minus check">
                        <input type="text" name="quantity" value="<?= $item->getQuantity() ?>" class="qty" id="qty-<?= $item->getUUID() ?>">
                        <input type="button" value="+" class="plus check">
                    </div>
                </td>

                <td class="cart-product-subtotal">
                    <span class="amount" id="total-<?= $item->getUUID() ?>"><?= $item->getQuantity() * $item->getPrice() ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="cart_item">
            <td colspan="6">
                <div class="row justify-content-between align-items-center py-2 col-mb-30">
                    <div class="col-lg-auto ps-lg-0">
<!--                        <div class="row align-items-center">-->
<!--                            <div class="col-md-8">-->
<!--                                <input type="text" value="" class="form-control text-center text-md-start" placeholder="Enter Coupon Code..">-->
<!--                            </div>-->
<!--                            <div class="col-md-4 mt-3 mt-md-0">-->
<!--                                <a href="#" class="button button-small button-3d button-black m-0" style="--cnvs-btn-padding-y:7px;line-height:22px;">Apply Coupon</a>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                    <div class="col-lg-auto pe-lg-0">
<!--                        <a href="#" class="button button-small button-3d m-0">Update Cart</a>-->
                        <a href="<?= Url::to('/order') ?>" style="display: <?= !empty($model->getItems()) ? "" : "none" ?>" class="button button-small button-3d mt-2 mt-sm-0 me-0 mb-0">Proceed to Checkout</a>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>