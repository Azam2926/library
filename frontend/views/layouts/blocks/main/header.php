<?php

/* @var $this yii\web\View */

?>
<header id="header" class="full-header">
    <div id="header-wrap" class="">
        <div class="container">
            <div class="header-row top-search-parent">

                <div id="logo">
                    <a href="/">
                        <img class="logo-default" srcset="/canvas/images/logo.png, /canvas/images/logo@2x.png 2x"
                             src="/canvas/images/logo@2x.png" alt="Canvas Logo">
                        <img class="logo-dark" srcset="/canvas/images/logo-dark.png, /canvas/images/logo-dark@2x.png 2x"
                             src="/canvas/images/logo-dark@2x.png" alt="Canvas Logo">
                    </a>
                </div>
                <div class="header-misc">

                    <div id="top-theme-toggle" class="header-misc-icon">
                        <button type="button" class="btn btn-sm body-scheme-toggle btn-dark" data-bodyclass-toggle="dark" data-add-class="btn-warning" data-remove-class="btn-dark" data-add-html="<i class='bi-brightness-high'></i><span class='visually-hidden'>Light Mode</span>" data-remove-html="<i class='bi-moon-stars'></i><span class='visually-hidden'>Dark Mode</span>"><i class="bi-moon-stars"></i><span class="visually-hidden">Dark Mode</span></button>
                    </div>

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

                <nav class="primary-menu primary-menu-init">
                    <ul class="menu-container">
                        <li class="menu-item">
                            <a class="menu-link" href="/">
                                <div>Home<i class="sub-menu-indicator fa-solid fa-caret-down"></i></div>
                            </a>
                        </li>
                        <li class="menu-item sub-menu">
                            <a class="menu-link" href="/resources">
                                <div>Books<i class="sub-menu-indicator fa-solid fa-caret-down"></i></div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header>
