<?php

use yii\bootstrap5\Html;
use common\models\Subject;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this View */
/* @var $model Subject */
/* @var $parentSubjectList ArrayHelper */

$this->title = 'Update Subject: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentSubjectList' => $parentSubjectList
    ]) ?>

</div>
