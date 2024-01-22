<?php

use common\models\Resource;
use frontend\components\Stats;

/* @var $this yii\web\View */
/** @var $new_resources Resource[] */
/** @var $new_electron_resources Resource[] */
/** @var $new_audio_resources Resource[] */
/** @var $new_video_resources Resource[] */
/** @var $statistics Stats */

$this->title = 'Library app';
?>
<?= $this->render('blocks/index/features') ?>
<?= $this->render('blocks/index/featured_books') ?>
<?= $this->render('blocks/index/new_books') ?>
<?= $this->render('blocks/index/links') ?>
