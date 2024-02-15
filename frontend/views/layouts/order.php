<?php

/* @var $this View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\CanvasCartAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\web\View;

CanvasCartAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" dir="ltr" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Book shop cart">
        <meta name="description" content="Book shop">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <?php $this->head() ?>
    </head>
    <body class="stretched">
    <?php $this->beginBody() ?>

    <div id="wrapper">
        <?= $this->render('blocks/header') ?>

        <?= $this->render('blocks/order/title') ?>

        <section id="content">
            <div class="content-wrap">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </section>

        <?= $this->render('blocks/order/footer') ?>
    </div>

    <div id="gotoTop" class="uil uil-angle-up"></div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
