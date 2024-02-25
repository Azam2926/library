<?php
/** @var Resource $resource */

/** @var View $this */
/** @var Reviews $reviewModel */
/** @var ReviewResponseDTO $reviewList */

use common\models\Resource;
use common\models\Reviews;
use frontend\dto\ReviewResponseDTO;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use yii\web\View;

$reviewCount = array_reduce($reviewList->getData(), function($countArray, $data) {return $countArray + count($data->getReviewList());}, 0);

$this->registerJs(<<<JS
    const uid = document.getElementById('uuid-id')
    const form = document.getElementById('add-to-cart')
    const qty = $('input[type=number]')
    const addBtn = $('#add-to-cart-button')
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    form.addEventListener('submit', (e) => {
        e.preventDefault()
        $.ajaxSetup({
            beforeSend: () => {
                addBtn.html('<div class="css3-spinner" style="--cnvs-loader-color:var(--cnvs-themecolor);"><div class="css3-spinner-clip-rotate"><div></div></div></div>')
                addBtn.attr('disabled', true)
                
            }
        })
        $.post(
            '/cart/add-to-cart', 
            {qty: qty.val(), uuid: uid.value, '_csrf-frontend': csrfToken },
            (data) => {
                $('#top-cart-modal').html(data)
                addBtn.text('Add to cart')
                addBtn.attr('disabled', false)
            }
            )
            .fail(e => {
                if (e.status === 401) {
                    window.location = '/site/login'
                    window.reload()
                }
            })
    })

JS, 3);
$this->registerAssetBundle(JqueryAsset::class, 3);

$this->registerJs(<<<JS

$(document).ready(function (){
    
    $("#review_create").click(function (){
        var rating = $("#template-reviewform-rating").val();
        var comment = $("#textarea-comment").val();
        var uuid = $("#uuid-id").val();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        
        // alert(uuid);
        $.post('/site/review', {uuid: uuid, rating: rating, comment:comment, '_csrf-frontend': csrfToken})
        .done(function (response){
            if(response==true){
                 $('#reviewFormModal').modal('hide');
                  $('#template-reviewform-rating').val('');
                  $('#textarea-comment').val('');
            }
            else{
                alert("xatolik mavjud");
            }
        })
        .fail(e => {
               alert("xatolik bor");
        })
    })
})

JS);

?>
<input type="text" id="uuid-id" hidden="hidden" value="<?= $resource->uuid ?>">
<div class="container">

    <div class="single-product">
        <div class="product">
            <div class="row gutter-40">

                <div class="col-md-6">

                    <!-- Product Single - Gallery
                    ============================================= -->
                    <div class="product-image">
                        <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                            <div class="flexslider">
                                <div class="slider-wrap" data-lightbox="gallery">
                                    <?php foreach ($resource->images as $image): ?>
                                        <div class="slide" data-thumb="<?= $image->getUploadedFileUrlFromFrontend() ?>">
                                            <a href="<?= $image->getUploadedFileUrlFromFrontend() ?>"
                                               title="<?= $image->name ?>"
                                               data-lightbox="gallery-item">
                                                <img src="<?= $image->getUploadedFileUrlFromFrontend() ?>"
                                                     alt="<?= $image->path ?>">
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="sale-flash badge bg-danger p-2">Sale!</div>
                    </div><!-- Product Single - Gallery End -->

                </div>

                <div class="col-md-6 product-desc">

                    <div class="d-flex align-items-center justify-content-between">
                        <div class="product-price"><?= $resource->price ?></div>
                        <div class="product-rating">
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-half"></i>
                            <i class="bi-star"></i>
                        </div>
                    </div>

                    <div class="line"></div>

                    <form id="add-to-cart" class="cart mb-0 d-flex justify-content-between align-items-center">
                        <div class="quantity">
                            <input type="button" value="-" class="minus">
                            <input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="qty">
                            <input type="button" value="+" class="plus">
                        </div>
                        <button type="submit" id="add-to-cart-button" class="add-to-cart button m-0">Add to cart</button>
                    </form>

                    <div class="line"></div>

                    <p><?= $resource->description ?></p>

                </div>

                <div class="w-100"></div>

                <div class="col-12 mt-5">

                    <div class="mb-0">

                        <ul class="nav canvas-tabs tabs nav-tabs mb-3" id="tab-1" role="tablist"
                            style="--bs-nav-link-font-weight: 500;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="canvas-tabs-1-tab" data-bs-toggle="pill"
                                        data-bs-target="#tabs-1"
                                        type="button" role="tab" aria-controls="canvas-tabs-1" aria-selected="true"><i
                                            class="me-1 bi-justify"></i><span class="d-none d-md-inline-block">
														Description</span></a></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="canvas-tabs-2-tab" data-bs-toggle="pill"
                                        data-bs-target="#tabs-2" type="button"
                                        role="tab" aria-controls="canvas-tabs-2" aria-selected="false"><i
                                            class="me-1 bi-info-circle-fill"></i><span
                                            class="d-none d-md-inline-block"> Additional Information</span></a></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="canvas-tabs-3-tab" data-bs-toggle="pill"
                                        data-bs-target="#tabs-3" type="button"
                                        role="tab" aria-controls="canvas-tabs-3" aria-selected="false"><i
                                            class="me-1 bi-star-fill"></i><span
                                            class="d-none d-md-inline-block"> Reviews (<?= $reviewCount; ?>)</span></a></button>
                            </li>
                        </ul>

                        <div id="canvas-tab-alt-content" class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel"
                                 aria-labelledby="canvas-tabs-1-tab"
                                 tabindex="0"><?= $resource->description ?></div>
                            <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="canvas-tabs-2-tab"
                                 tabindex="0">

                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Size</td>
                                        <td>Small, Medium &amp; Large</td>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <td>Pink &amp; White</td>
                                    </tr>
                                    <tr>
                                        <td>Waist</td>
                                        <td>26 cm</td>
                                    </tr>
                                    <tr>
                                        <td>Length</td>
                                        <td>40 cm</td>
                                    </tr>
                                    <tr>
                                        <td>Chest</td>
                                        <td>33 inches</td>
                                    </tr>
                                    <tr>
                                        <td>Fabric</td>
                                        <td>Cotton, Silk &amp; Synthetic</td>
                                    </tr>
                                    <tr>
                                        <td>Warranty</td>
                                        <td>3 Months</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="canvas-tabs-3-tab" tabindex="0">
                                <div id="reviews">
                                    <ol class="commentlist">
                                        <?php foreach ($reviewList->getData() as $reviewListDTO): ?>
                                            <?php foreach ($reviewListDTO->getReviewList() as $item): ?>
                                               <li class="comment even thread-even depth-1" id="li-comment-1">
                                                   <div id="comment-1" class="comment-wrap">
                                                       <div class="comment-meta">
                                                           <div class="comment-author vcard">
                                                               <span class="comment-avatar">
                                                                   <img alt='Image'
                                                                 src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                                                                 height='60' width='60'>
                                                               </span>
                                                           </div>
                                                       </div>
                                                       <div class="comment-content">
                                                           <div class="comment-author"><?= $reviewListDTO->getUsername();?>
                                                        <span>
                                                            <a href="#" title="Permalink to this comment"><?= $item->getCreatedAt() ?></a>
                                                        </span>
                                                    </div>
                                                           <p><?= $item->getComment() ?></p>
                                                           <div class="review-comment-ratings">
                                                               <?php for ($i=0; $i< $item->getRating(); $i++): ?>
                                                                   <?= '<i class="bi-star-fill"></i>' ?>
                                                               <?php endfor; ?>
                                                           </div>
                                                       </div>
                                                       <div class="clear"></div>
                                                   </div>
                                               </li>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                    </ol>
                                    <!-- Modal Reviews -->
                                    <div class="text-end">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#reviewFormModal" class="button button-3d m-0">Add a Review</a>
                                    </div>
                                    <div class="modal fade" id="reviewFormModal" tabindex="-1" role="dialog"
                                         aria-labelledby="reviewFormModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="reviewFormModalLabel">Submit a Review</h4>
                                                    <button type="button" class="btn-close btn-sm"
                                                            data-bs-dismiss="modal"
                                                            aria-hidden="true">

                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php $form = ActiveForm::begin([
                                                        'options' => [
                                                            'class' => 'row mb-0',
                                                            'name' => 'template-reviewform',
                                                            'enctype' => 'multipart/form-data',
                                                        ],
                                                        'method' => 'post',
                                                        'id' => 'template-reviewform',
                                                    ]); ?>

                                                    <div class="col-12 mb-3">
                                                        <?= $form->field($reviewModel, 'rating')->dropDownList(
                                                            ['' => '-- Select rating --', 1 => 1,2 => 2, 3 => 3, 4 => 4, 5 => 5],
                                                            ['class' => 'form-select', 'id' => 'template-reviewform-rating']
                                                        ) ?>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <?= $form->field($reviewModel, 'comment')->textarea(
                                                            ['class' => 'form-control', 'rows' => 5, 'id'=> 'textarea-comment']
                                                        ) ?>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="button button-3d m-0" type="button"
                                                                    id="review_create"
                                                                    name="review_create"
                                                                    value="button">Submit Review
                                                        </button>
                                                    </div>
                                                    <?php ActiveForm::end(); ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Reviews End -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>