<?php
/** @var Resource $resource */

/** @var View $this */

use common\models\Resource;
use yii\web\JqueryAsset;
use yii\web\View;

$this->registerJs(<<<JS
    const form = document.getElementById('add-to-cart')
    const addButton = document.getElementById('add-to-cart-button')
    const uuid = document.getElementById('resource-uuid')
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        console.log(addButton.value)
        $.post('add-to-cart', {qty: addButton.value, uuid: uuid.value})
    })

JS, 3);
$this->registerAssetBundle(JqueryAsset::class, 3);

?>
<input type="text" id="resource-uuid" hidden="hidden" value="<?= $resource->uuid ?>">
<div class="container">

    <div class="single-product">
        <div class="product">
            <div class="row gutter-40">

                <div class="col-md-5">

                    <!-- Product Single - Gallery
                    ============================================= -->
                    <div class="product-image">
                        <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                            <div class="flexslider">
                                <div class="slider-wrap" data-lightbox="gallery">
                                    <?php foreach ($resource->images as $image): ?>
                                        <div class="slide" data-thumb="<?= $image->getUploadedFileUrlFromFrontend() ?>">
                                            <a href="<?= $image->getUploadedFileUrlFromFrontend() ?>"
                                               title="Pink Printed Dress - Front View"
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

                <div class="col-md-5 product-desc">

                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Product Single - Price
                        ============================================= -->
                        <div class="product-price"><?= $resource->price ?></div><!-- Product Single - Price End -->

                        <!-- Product Single - Rating
                        ============================================= -->
                        <div class="product-rating">
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-half"></i>
                            <i class="bi-star"></i>
                        </div><!-- Product Single - Rating End -->

                    </div>

                    <div class="line"></div>

                    <!-- Product Single - Quantity & Cart Button
                    ============================================= -->
                    <form id="add-to-cart" class="cart mb-0 d-flex justify-content-between align-items-center">
                        <div class="quantity">
                            <input type="button" value="-" class="minus">
                            <input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="qty"
                                   id="add-to-cart-button">
                            <input type="button" value="+" class="plus">
                        </div>
                        <button type="submit" class="add-to-cart button m-0">Add to cart</button>
                    </form>
                    <!-- Product Single - Quantity & Cart Button End -->

                    <div class="line"></div>

                    <!-- Product Single - Short Description
                    ============================================= -->
                    <p><?= $resource->description ?></p>
                    <ul class="iconlist">
                        <li><i class="fa-solid fa-caret-right"></i> Dynamic Color Options</li>
                        <li><i class="fa-solid fa-caret-right"></i> Lots of Size Options</li>
                        <li><i class="fa-solid fa-caret-right"></i> 30-Day Return Policy</li>
                    </ul><!-- Product Single - Short Description End -->

                    <!-- Product Single - Meta
                    ============================================= -->
                    <div class="card product-meta">
                        <div class="card-body">
                            <span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">8465415</span></span>
                            <span class="posted_in">Category: <a href="#" rel="tag">Dress</a>.</span>
                            <span class="tagged_as">Tags: <a href="#" rel="tag">Pink</a>, <a href="#"
                                                                                             rel="tag">Short</a>, <a
                                        href="#" rel="tag">Dress</a>, <a href="#" rel="tag">Printed</a>.</span>
                        </div>
                    </div><!-- Product Single - Meta End -->

                    <!-- Product Single - Share
                    ============================================= -->
                    <div class="card mt-6 pt-4 border-0 border-top rounded-0 border-default">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="fs-6 fw-semibold mb-0">Share:</h6>
                                <div class="d-flex">
                                    <a href="#"
                                       class="social-icon si-small text-white border-transparent rounded-circle bg-facebook"
                                       title="Facebook">
                                        <i class="fa-brands fa-facebook-f"></i>
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>

                                    <a href="#"
                                       class="social-icon si-small text-white border-transparent rounded-circle bg-x-twitter"
                                       title="Twitter">
                                        <i class="fa-brands fa-x-twitter"></i>
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>

                                    <a href="#"
                                       class="social-icon si-small text-white border-transparent rounded-circle bg-pinterest"
                                       title="Pinterest">
                                        <i class="fa-brands fa-pinterest-p"></i>
                                        <i class="fa-brands fa-pinterest-p"></i>
                                    </a>

                                    <a href="#"
                                       class="social-icon si-small text-white border-transparent rounded-circle bg-whatsapp"
                                       title="Whatsapp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>

                                    <a href="#"
                                       class="social-icon si-small text-white border-transparent rounded-circle bg-rss"
                                       title="RSS">
                                        <i class="fa-solid fa-rss"></i>
                                        <i class="fa-solid fa-rss"></i>
                                    </a>

                                    <a href="#"
                                       class="social-icon si-small text-white border-transparent rounded-circle bg-email3 me-0"
                                       title="Mail">
                                        <i class="fa-solid fa-envelope"></i>
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- Product Single - Share End -->

                </div>

                <div class="col-md-2">

                    <a href="#" title="Brand Logo" class="d-none d-md-block"><img src="/canvas/images/shop/brand.jpg"
                                                                                  alt="Brand Logo"></a>

                    <div class="divider divider-center"><i class="bi-circle"></i></div>

                    <div class="feature-box fbox-plain fbox-dark fbox-sm">
                        <div class="fbox-icon">
                            <i class="bi-hand-thumbs-up"></i>
                        </div>
                        <div class="fbox-content fbox-content-sm">
                            <h3>100% Original</h3>
                            <p class="mt-0">We guarantee you the sale of Original Brands.</p>
                        </div>
                    </div>

                    <div class="feature-box fbox-plain fbox-dark fbox-sm mt-4">
                        <div class="fbox-icon">
                            <i class="bi-credit-card"></i>
                        </div>
                        <div class="fbox-content fbox-content-sm">
                            <h3>Payment Options</h3>
                            <p class="mt-0">We accept Visa, MasterCard and American Express.</p>
                        </div>
                    </div>

                    <div class="feature-box fbox-plain fbox-dark fbox-sm mt-4">
                        <div class="fbox-icon">
                            <i class="bi-truck"></i>
                        </div>
                        <div class="fbox-content fbox-content-sm">
                            <h3>Free Shipping</h3>
                            <p class="mt-0">Free Delivery to 100+ Locations on orders above $40.</p>
                        </div>
                    </div>

                    <div class="feature-box fbox-plain fbox-dark fbox-sm mt-4">
                        <div class="fbox-icon">
                            <i class="bi-arrow-counterclockwise"></i>
                        </div>
                        <div class="fbox-content fbox-content-sm">
                            <h3>30-Days Returns</h3>
                            <p class="mt-0">Return or exchange items purchased within 30 days.</p>
                        </div>
                    </div>

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
                                            class="d-none d-md-inline-block"> Reviews (2)</span></a></button>
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
                            <div class="tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="canvas-tabs-3-tab"
                                 tabindex="0">

                                <div id="reviews">

                                    <ol class="commentlist">

                                        <li class="comment even thread-even depth-1" id="li-comment-1">
                                            <div id="comment-1" class="comment-wrap">

                                                <div class="comment-meta">
                                                    <div class="comment-author vcard">
																		<span class="comment-avatar">
																			<img alt='Image'
                                                                                 src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                                                                                 height='60' width='60'></span>
                                                    </div>
                                                </div>

                                                <div class="comment-content">
                                                    <div class="comment-author">John Doe<span><a href="#"
                                                                                                 title="Permalink to this comment">April 24, 2021 at 10:46AM</a></span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                                                        perferendis aliquid
                                                        tenetur. Aliquid, tempora, sit aliquam officiis nihil autem eum
                                                        at repellendus
                                                        facilis quaerat consequatur commodi laborum saepe non nemo nam
                                                        maxime quis error
                                                        tempore possimus est quasi reprehenderit fuga!</p>
                                                    <div class="review-comment-ratings">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-half"></i>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </li>

                                        <li class="comment even thread-even depth-1" id="li-comment-2">
                                            <div id="comment-2" class="comment-wrap">

                                                <div class="comment-meta">
                                                    <div class="comment-author vcard">
																		<span class="comment-avatar">
																			<img alt='Image'
                                                                                 src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                                                                                 height='60' width='60'></span>
                                                    </div>
                                                </div>

                                                <div class="comment-content">
                                                    <div class="comment-author">Mary Jane<span><a href="#"
                                                                                                  title="Permalink to this comment">June 16, 2021 at 6:00PM</a></span>
                                                    </div>
                                                    <p>Quasi, blanditiis, neque ipsum numquam odit asperiores hic dolor
                                                        necessitatibus
                                                        libero sequi amet voluptatibus ipsam velit qui harum temporibus
                                                        cum nemo iste
                                                        aperiam explicabo fuga odio ratione sint fugiat consequuntur
                                                        vitae adipisci delectus
                                                        eum incidunt possimus tenetur excepturi at accusantium quod
                                                        doloremque reprehenderit
                                                        aut expedita labore error atque?</p>
                                                    <div class="review-comment-ratings">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star"></i>
                                                        <i class="bi-star"></i>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </li>

                                    </ol>

                                    <!-- Modal Reviews
                                                                                ============================================= -->
                                    <div class="text-end">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#reviewFormModal"
                                           class="button button-3d m-0">Add a Review</a>
                                    </div>

                                    <div class="modal fade" id="reviewFormModal" tabindex="-1" role="dialog"
                                         aria-labelledby="reviewFormModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="reviewFormModalLabel">Submit a
                                                        Review</h4>
                                                    <button type="button" class="btn-close btn-sm"
                                                            data-bs-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row mb-0" id="template-reviewform"
                                                          name="template-reviewform" action="#"
                                                          method="post">

                                                        <div class="col-6 mb-3">
                                                            <label for="template-reviewform-name">Name <small>*</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-text"><i
                                                                            class="uil uil-user"></i></div>
                                                                <input type="text" id="template-reviewform-name"
                                                                       name="template-reviewform-name" value=""
                                                                       class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-6 mb-3">
                                                            <label for="template-reviewform-email">Email
                                                                <small>*</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-text">@</div>
                                                                <input type="email" id="template-reviewform-email"
                                                                       name="template-reviewform-email" value=""
                                                                       class="required email form-control">
                                                            </div>
                                                        </div>

                                                        <div class="w-100"></div>

                                                        <div class="col-12 mb-3">
                                                            <label for="template-reviewform-rating">Rating</label>
                                                            <select id="template-reviewform-rating"
                                                                    name="template-reviewform-rating"
                                                                    class="form-select">
                                                                <option value="">-- Select One --</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>

                                                        <div class="w-100"></div>

                                                        <div class="col-12 mb-3">
                                                            <label for="template-reviewform-comment">Comment
                                                                <small>*</small></label>
                                                            <textarea class="required form-control"
                                                                      id="template-reviewform-comment"
                                                                      name="template-reviewform-comment" rows="6"
                                                                      cols="30"></textarea>
                                                        </div>

                                                        <div class="col-12">
                                                            <button class="button button-3d m-0" type="submit"
                                                                    id="template-reviewform-submit"
                                                                    name="template-reviewform-submit"
                                                                    value="submit">Submit Review
                                                            </button>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Modal Reviews End -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="w-100">

        <h4>Related Products</h4>

        <div class="owl-carousel product-carousel carousel-widget" data-margin="30" data-pagi="false"
             data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3" data-items-xl="4">

            <div class="oc-item">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img src="/canvas/images/shop/dress/1.jpg" alt="Checked Short Dress"></a>
                        <a href="#"><img src="/canvas/images/shop/dress/1-1.jpg" alt="Checked Short Dress"></a>
                        <div class="badge bg-success p-2">50% Off*</div>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content align-items-end justify-content-between"
                                 data-hover-animate="fadeIn" data-hover-speed="400">
                                <a href="#" class="btn btn-dark me-2" title="Add to Cart"><i
                                            class="bi-bag-plus"></i></a>
                                <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"
                                   title="Quick View"><i class="bi-eye"></i></a>
                            </div>
                            <div class="bg-overlay-bg bg-transparent"></div>
                        </div>
                    </div>
                    <div class="product-desc text-center">
                        <div class="product-title"><h3><a href="#">Checked Short Dress</a></h3></div>
                        <div class="product-price">
                            <del>$24.99</del>
                            <ins>$12.49</ins>
                        </div>
                        <div class="product-rating">
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-half"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="oc-item">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img src="/canvas/images/shop/pants/1-1.jpg" alt="Slim Fit Chinos"></a>
                        <a href="#"><img src="/canvas/images/shop/pants/1.jpg" alt="Slim Fit Chinos"></a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content align-items-end justify-content-between"
                                 data-hover-animate="fadeIn" data-hover-speed="400">
                                <a href="#" class="btn btn-dark me-2" title="Add to Cart"><i
                                            class="bi-bag-plus"></i></a>
                                <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"
                                   title="Quick View"><i class="bi-eye"></i></a>
                            </div>
                            <div class="bg-overlay-bg bg-transparent"></div>
                        </div>
                    </div>
                    <div class="product-desc text-center">
                        <div class="product-title"><h3><a href="#">Slim Fit Chinos</a></h3></div>
                        <div class="product-price">$39.99</div>
                        <div class="product-rating">
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-half"></i>
                            <i class="bi-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="oc-item">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img src="/canvas/images/shop/shoes/1-1.jpg" alt="Dark Brown Boots"></a>
                        <a href="#"><img src="/canvas/images/shop/shoes/1.jpg" alt="Dark Brown Boots"></a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content align-items-end justify-content-between"
                                 data-hover-animate="fadeIn" data-hover-speed="400">
                                <a href="#" class="btn btn-dark me-2" title="Add to Cart"><i
                                            class="bi-bag-plus"></i></a>
                                <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"
                                   title="Quick View"><i class="bi-eye"></i></a>
                            </div>
                            <div class="bg-overlay-bg bg-transparent"></div>
                        </div>
                    </div>
                    <div class="product-desc text-center">
                        <div class="product-title"><h3><a href="#">Dark Brown Boots</a></h3></div>
                        <div class="product-price">$49</div>
                        <div class="product-rating">
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star"></i>
                            <i class="bi-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="oc-item">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img src="/canvas/images/shop/dress/2.jpg" alt="Light Blue Denim Dress"></a>
                        <a href="#"><img src="/canvas/images/shop/dress/2-2.jpg" alt="Light Blue Denim Dress"></a>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content align-items-end justify-content-between"
                                 data-hover-animate="fadeIn" data-hover-speed="400">
                                <a href="#" class="btn btn-dark me-2" title="Add to Cart"><i
                                            class="bi-bag-plus"></i></a>
                                <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"
                                   title="Quick View"><i class="bi-eye"></i></a>
                            </div>
                            <div class="bg-overlay-bg bg-transparent"></div>
                        </div>
                    </div>
                    <div class="product-desc text-center">
                        <div class="product-title"><h3><a href="#">Light Blue Denim Dress</a></h3></div>
                        <div class="product-price">$19.95</div>
                        <div class="product-rating">
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="oc-item">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img src="/canvas/images/shop/sunglasses/1.jpg" alt="Unisex Sunglasses"></a>
                        <a href="#"><img src="/canvas/images/shop/sunglasses/1-1.jpg" alt="Unisex Sunglasses"></a>
                        <div class="badge bg-success p-2">Sale!</div>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content align-items-end justify-content-between"
                                 data-hover-animate="fadeIn" data-hover-speed="400">
                                <a href="#" class="btn btn-dark me-2" title="Add to Cart"><i
                                            class="bi-bag-plus"></i></a>
                                <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"
                                   title="Quick View"><i class="bi-eye"></i></a>
                            </div>
                            <div class="bg-overlay-bg bg-transparent"></div>
                        </div>
                    </div>
                    <div class="product-desc text-center">
                        <div class="product-title"><h3><a href="#">Unisex Sunglasses</a></h3></div>
                        <div class="product-price">
                            <del>$19.99</del>
                            <ins>$11.99</ins>
                        </div>
                        <div class="product-rating">
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star-fill"></i>
                            <i class="bi-star"></i>
                            <i class="bi-star"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>