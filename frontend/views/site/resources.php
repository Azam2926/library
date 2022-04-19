<?php
/* @var $this View */

/* @var $filterModel ResourceFilter */

/* @var $dataProvider ActiveDataProvider */

use frontend\models\ResourceFilter;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = 'Resurslar';
?>
<div id="resources">
    <?php Pjax::begin([
        'id' => 'resource_pjax',
        'options' => ['class' => 'container'],
        'clientOptions' => ['container' => '#resources-list'],
        'timeout' => 3000
    ]) ?>

    <div class="row">
        <div class="col-md-5 col-lg-4 pl-1 pr-4">
            <?= $this->render('_resources_filter', ['filterModel' => $filterModel]) ?>
        </div>
        <div class="col-md-7 col-lg-8 px-1">
            <?= $this->render('resources_list', ['dataProvider' => $dataProvider]) ?>
        </div>
    </div>

    <?php Pjax::end() ?>
</div>