<?php

use common\models\Resource;
use yii\web\View;

/* @var $this View */
/* @var $model Resource */

$this->registerJs(<<<JS
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    $('.add-to-cart').each(function () {
        const btn = this
        this.addEventListener('click', (e) => {
        e.preventDefault()
        $.ajaxSetup({
            beforeSend: () => {
                $(btn).html('<div class="css3-spinner" style="--cnvs-loader-color:var(--cnvs-themecolor);"><div class="css3-spinner-clip-rotate"><div></div></div></div>')
                $(btn).attr('disabled', true)
                
            }
        });
        $.post(
            '/cart/add-to-cart', 
            {qty: 1, uuid: this.dataset.uid, '_csrf-frontend': csrfToken },
            (data) => {
                $('#top-cart-modal').html(data)
                $(btn).html('<i class="uil uil-shopping-cart me-1"></i> Add to Cart')
                $(btn).attr('disabled', false)
            }
            )
            .fail(e => {
                if (e.status === 401) {
                    window.location = '/site/login'
                    window.reload()
                }
            })
    })
    })

JS, 3);
?>
<div class="grid-inner">
    <div class="product-image">
        <?php foreach ($model->images as $image): ?>
            <a href="<?= $model->getUrl() ?>">
                <img src="<?= $image->getUploadedFileUrlFromFrontend() ?>"
                     alt="<?= $image->name ?>">
            </a>
        <?php endforeach; ?>
        <div class="bg-overlay">
            <div class="bg-overlay-bg bg-transparent"></div>
        </div>
    </div>
    <div class="product-desc text-center">
        <div class="product-title"><h3><a href="<?= $model->getUrl() ?>"><?= $model->title ?></a></h3></div>
        <div class="product-price">
            <?= $model->price ?>
        </div>
        <button data-uid="<?= $model->uuid ?>" class="btn btn-sm btn-dark px-3 mt-2 add-to-cart">
            <i class="uil uil-shopping-cart me-1"></i> Add to Cart
        </button>
    </div>
</div>
