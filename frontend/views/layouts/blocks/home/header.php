<?php

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

                <div class="header-misc col-lg-auto order-lg-4 ms-auto ms-lg-0 justify-content-lg-end ">

                    <?= $this->render("../commons/top-login") ?>

                    <div id="top-cart-modal">
                        <?= Yii::$app->runAction('/cart/user-cart') ?>
                    </div>

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
                        <li class="menu-item"><a class="menu-link" href="/">
                                <div>Home</div>
                            </a></li>
                        <li class="menu-item"><a class="menu-link" href="/resources">
                                <div>Books</div>
                            </a></li>
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>

        </div>

    </div>
    <div class="header-wrap-clone"></div>
</header>