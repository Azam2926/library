<?php

use common\models\Resource;

/* @var $this yii\web\View */
/** @var $books Resource[] */

$this->title = 'Book app';

?>
<?php if (sizeof($books) > 0): ?>
    <div class="clear mt-lg-6"></div>

    <div class="section py-lg-0 pt-0">
        <div class="row g-5 align-items-center">
            <div class="col-md-6">
                <img src="<?= $books[0]->getFirstImageUrlFront() ?>" alt="<?= $books[0]->title ?>">
            </div>

            <div class="col-md-6 px-5">
                <div class="mw-xs mx-auto">
                    <h2 class="font-secondary"><?= $books[0]->title ?></h2>
                    <p class="lead"><?= $books[0]->description ?></p>
                    <div>
                        <a href="<?= $books[0]->getUrl() ?>"
                           class="button bg-white text-dark h-bg-dark h-text-light px-4 rounded-pill mx-0">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clear"></div>

    <?php for ($i = 1; $i < count($books); $i++) {
        $book = $books[$i];
        ?>

        <?php if ($i % 2 == 1): ?>
            <div class="section bg-transparent my-0 my-lg-5 pt-0 pt-lg-5">

                <div class="container-fluid">

                    <div class="row g-5">
                        <div class="col-md-7 parallax scroll-detect min-vh-lg-90 min-vh-50">
                            <img src="<?= $book->getFirstImageUrlFront() ?>" class="parallax-bg"
                                 alt="<?= $book->title ?>">
                        </div>

                        <div class="col-md-5 d-md-flex flex-column align-items-center justify-content-center">
                            <div>
                                <p class="mb-3 op-06">Featured Collection</p>
                                <h2 class="display-5 mb-5"><?= $book->title ?></h2>
                                <h4 class="mb-3">
                                    <?= $book->price ?> <span
                                            class="text-black-50 text-smaller"> Onwards</span></h4>
                                <a href="<?= $books[0]->getUrl() ?>" class="button button-dark h-text-dark rounded-pill fw-normal">Shop Now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php else: ?>

            <div class="section my-0 pt-0 pt-lg-5 my-lg-5 bg-transparent">

                <div class="container-fluid">

                    <div class="row g-5 flex-md-row-reverse">
                        <div class="col-md-7 parallax scroll-detect min-vh-lg-90 min-vh-50">
                            <img src="<?= $book->getFirstImageUrlFront() ?>" class="parallax-bg" alt="<?= $book->title ?>">
                        </div>

                        <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <p class="mb-3 op-06">Latest Collection</p>
                                <h2 class="display-5 mb-5"><?= $book->title ?></h2>
                                <h4 class="mb-3">
                                    <?= $book->price ?> <span
                                            class="text-black-50 text-smaller"> Onwards</span></h4>
                                <a href="<?= $books[0]->getUrl() ?>" class="button button-dark h-text-dark rounded-pill fw-normal">Shop Now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endif; ?>

    <?php } ?>
<?php endif; ?>

