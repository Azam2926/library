<?php

use common\models\Resource;
use frontend\components\Stats;

/* @var $this yii\web\View */
/** @var $new_resources Resource[] */
/** @var $featured_books Resource[] */

$this->title = 'Library app';
?>
<?= $this->render('blocks/index/features') ?>
<?= $this->render('blocks/index/featured_books', ['books' => $featured_books]) ?>
<?= $this->render('blocks/index/new_books', ['resources' => $new_resources]) ?>
<?= $this->render('blocks/index/links') ?>
