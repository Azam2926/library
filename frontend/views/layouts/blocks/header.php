<?php

use yii\bootstrap5\Html;
/* @var $this yii\web\View */

?>
<header id="header" class="header-size-md dark transparent-header" data-sticky-shrink="false"
        data-sticky-class="not-dark">
    <div id="header-wrap">
        <div class="container-fluid">
            <div class="header-row justify-content-lg-between">

                <!-- Logo
                ============================================= -->
                <div id="logo" class="me-lg-auto me-0 order-lg-2 col-lg-auto">
                    <a href="/">
                        <img class="logo-default"
                             srcset="/canvas/demos/shop-2/images/logo.png, /canvas/demos/shop-2/images/logo@2x.png 2x"
                             src="/canvas/demos/shop-2/images/logo@2x.png" alt="Canvas Logo">
                        <img class="logo-dark"
                             srcset="/canvas/demos/shop-2/images/logo-dark.png, /canvas/demos/shop-2/images/logo-dark@2x.png 2x"
                             src="/canvas/demos/shop-2/images/logo-dark@2x.png" alt="Canvas Logo">
                    </a>
                </div><!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu me-lg-0 order-lg-3 order-5">

                    <!-- Menu Left -->
                    <ul class="menu-container">
                        <li class="menu-item"><a class="menu-link" href="#">
                                <div>FAQs</div>
                            </a></li>
                        <li class="menu-item"><a class="menu-link" href="#">
                                <div>Journal</div>
                            </a></li><!-- .mega-menu end -->
                        <li class="menu-item"><a class="menu-link" href="#">
                                <div>Contact</div>
                            </a></li>
                    </ul>

                </nav><!-- #primary-menu end -->

                <div class="header-misc col-lg-auto order-lg-4 ms-auto ms-lg-0 justify-content-lg-end ">

                    <!-- Top Login
                    ============================================= -->
                    <div id="top-account" class="header-misc-icon px-3 dropdown">
                        <a href="#" id="dropdownMenuLink" data-bs-toggle="dropdown"
                           aria-expanded="false"><i class="bi-people"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php if (Yii::$app->user->isGuest) {
                                echo '<li><a class="dropdown-item" href="/site/login">Login</a></li>';
                            } else {
                                echo '<li>'
                                    . Html::beginForm(['/site/logout'])
                                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'dropdown-item']
                                    )
                                    . Html::endForm()
                                    . '</li>';
                            } ?>
                        </ul>
                    </div><!-- #top-search end -->

                    <!-- Top Cart
                    ============================================= -->
                    <div id="top-cart-modal">
                        <?= Yii::$app->runAction('/cart/user-cart') ?>
                    </div>
                    <!-- #top-cart end -->
                </div>

                <div class="primary-menu-trigger">
                    <button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
                        <span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
                    </button>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu with-arrows col-lg-auto me-lg-auto order-lg-1">

                    <!-- Menu Left -->
                    <ul class="menu-container">
                        <li class="menu-item"><a class="menu-link" href="#">
                                <div>Home</div>
                            </a></li>
                        <li class="menu-item"><a class="menu-link" href="#">
                                <div>Products</div>
                            </a></li>
                        <li class="menu-item"><a class="menu-link" href="#">
                                <div>New Arrivals</div>
                            </a></li>
                        <li class="menu-item"><a class="menu-link" href="#">
                                <div>Offers</div>
                            </a></li>
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>

        </div>

    </div>
    <div class="header-wrap-clone"></div>

</header>