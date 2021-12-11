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
<div class="site-index">

    <div class="new-resources py-5 my-3">
        <?= $this->render('_new_resources', ['title' => 'Yangi resurslar',
            'resources' => $new_resources
        ]) ?>
    </div>

    <div class="container statistics py-5 my-3">
        <?= $this->render('_statistics', ['statistics' => $statistics]) ?>
    </div>

    <div class="new-resources py-5 my-3">
        <?= $this->render('_new_resources', ['title' => 'Yangi elektron kitoblar',
            'resources' => $new_electron_resources
        ]) ?>
    </div>

    <div class="new-resources py-5 my-3">
        <?= $this->render('_new_resources', ['title' => 'Yangi audio kitoblar',
            'resources' => $new_audio_resources
        ]) ?>
    </div>

    <div class="new-resources py-5 my-3">
        <?= $this->render('_new_resources', ['title' => 'Yangi videolar',
            'resources' => $new_video_resources
        ]) ?>
    </div>

</div>
