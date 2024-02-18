<?php

use common\models\Resource;
use yii\web\View;

/* @var $this View */
/* @var $books Resource[] */

?>
<section id="slider"
         class="slider-element swiper_wrapper min-vh-md-100 min-vh-50 include-header include-topbar slider-parallax"
         data-loop="true" data-dots="true" data-speed="500" data-autolay="5000">
    <div class="slider-inner">

        <div class="swiper swiper-parent">
            <div class="swiper-wrapper">
                <?php foreach ($books as $book): ?>
                    <div class="swiper-slide dark">
                        <div class="container-fluid h-100 p-5 p-lg-6">
                            <div class="slider-caption justify-content-end">
                                <h2 data-animate="fadeInUp"><?= $book->title ?></h2>
                                <p class="my-4 text-smaller" data-animate="fadeInUp" data-delay="100">Featured
                                    Collection of
                                    2024.</p>
                                <div>
                                    <a href="/resource/<?= $book->uuid ?>" data-animate="fadeInUp" data-delay="200"
                                       class="button bg-color text-dark rounded-pill fw-normal">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide-bg"
                             style="background-image: url('<?= $book->getFirstImageUrlFront() ?>'); background-position: 50% 10%;"></div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="social-icons">
            <a href="#" class="social-icon si-small rounded-circle text-white bg-facebook">
                <i class="fa-brands fa-facebook-f text-white-50"></i>
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon si-small rounded-circle text-white bg-instagram">
                <i class="bi-instagram text-white-50"></i>
                <i class="bi-instagram"></i>
            </a>
            <a href="#" class="social-icon si-small rounded-circle text-white bg-youtube">
                <i class="fa-brands fa-youtube text-white-50"></i>
                <i class="fa-brands fa-youtube"></i>
            </a>
        </div>

    </div>
</section>