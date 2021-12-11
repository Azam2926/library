<?php
/** @var $statistics Stats */

use frontend\components\Stats;

?>

<h1 class="text-center mb-5 fw-bolder">Statistika</h1>

<div class="d-flex flex-wrap py-5 justify-content-md-evenly bg-secondary-color rounded text-white fs-4 gap-5">
    <div class="d-flex p-2">
        <span class="p-4 bg-primary-color rounded "><i class="fas fa-database"></i></span>
        <div class="d-flex flex-column align-items-center justify-content-between">
            <strong class="ms-2">Resurslar</strong>
            <span><?= $statistics->resources ?></span>
        </div>
    </div>
    <div class="d-flex p-2">
        <span class="p-4 bg-primary-color rounded "><i class="fas fa-eye"></i></span>
        <div class="d-flex flex-column align-items-center justify-content-between">
            <strong class="ms-2">Ko'rishlar soni</strong>
            <span><?= $statistics->resource_views ?></span>
        </div>
    </div>
    <div class="d-flex p-2">
        <span class="p-4 bg-primary-color rounded "><i class="fas fa-arrow-circle-down"></i></span>
        <div class="d-flex flex-column align-items-center justify-content-between">
            <strong class="ms-2">Yuklashlar soni</strong>
            <span><?= $statistics->resource_downloads ?></span>
        </div>
    </div>
</div>

