<?php

/* @var $this View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\CanvasAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\web\View;

CanvasAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" dir="ltr" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Madiyor;Azam">
        <meta name="description" content="Book shop">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="stretched">
    <?php $this->beginBody() ?>

    <div id="wrapper">
        <?= $this->render('blocks/main/header') ?>

        <section id="content">
            <div class="content-wrap">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </section>

        <?= $this->render('blocks/main/footer') ?>
    </div>

    <div id="gotoTop" class="uil uil-angle-up"></div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
