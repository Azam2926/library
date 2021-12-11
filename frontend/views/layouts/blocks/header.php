<?php
$title_publisher = Yii::$app->request->get('ResourceFilter')
    ? Yii::$app->request->get('ResourceFilter')['title_publisher']
    : '';
?>
<header class="border-bottom p-2 sticky-lg-top bg-white">
    <div class="container">
        <!-- bottom bar -->
        <div class="g-py-20 d-flex flex-wrap justify-content-between">
            <div>
                <a href="/">
                    <img class="me-3" width="410" src="https://library.tiiame.uz/images/logo-tiiame-uz.png" alt="logo-tiiame-lib">
                </a>

            </div>
            <div class="d-flex align-self-center mt-2 mt-lg-0 flex-wrap">
                <a href="mailto:eldor@tiiame.uz" class="g-color-gray-dark-v2 g-text-underline--none--hover">
                    <div class="g-me-25 my-1 d-flex">
                        <div class="me-2 align-self-center"><i class="fs-2 far fa-envelope"></i></div>
                        <div class="me-4">
                            <div class="g-line-height-1_2">eldor@tiiame.uz</div>
                            <div class="g-line-height-1_2"><strong class="clearfix">Email</strong></div>
                        </div>
                    </div>
                </a>
                <a href="tel:+998901752102" class="g-color-gray-dark-v2 g-text-underline--none--hover">
                    <div class="my-1 d-flex">
                        <div class="me-2 align-self-center"><i class="fs-2 fal fa-mobile-android"></i></div>
                        <div class="me-4">
                            <div class="g-line-height-1_2">+99890 175-21-02</div>
                            <div class="g-line-height-1_2"><strong class="clearfix">Telefon</strong></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- end of bottom bar -->
    </div>
</header>

<div class="container">
    <div class="search-bar rounded-bottom">
        <div class="container">
            <div class="row justify-content-around">
                <div class="my-3 col-md-3">
                    <a href="/site/resources" class="g-text-underline--none--hover ">
                        <span class="g-pr-5 align-middle"><i class="fs-5 align-middle fas fa-bars text-light"></i></span>
                        <span class="text-white align-middle g-font-size-14">Resurslar katalogi</span>
                    </a>
                </div>
                <form class="d-flex align-items-center my-3 mx-0 search-box col-md-6" action="/site/resources">
                    <div class="input-group flex-nowrap">
                        <input id="title_publisher" type="text" class="form-control" name="ResourceFilter[title_publisher]"
                               value="<?= $title_publisher ?>"
                               placeholder="Sarlavha yoki muallif bo‘yicha qidirish"
                        >
                        <button id="title_publisher-trigger" type="submit" class="input-group-text bg-secondary-color text-white pointer-event">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>