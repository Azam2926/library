<?php

use yii\bootstrap5\Html;
use common\models\Subject;
use yii\web\View;
use yii\helpers\ArrayHelper;

/* @var View */
/* @var $model Subject */
/* @var $parentSubjectList ArrayHelper */

$this->title = 'Create Subject';
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentSubjectList' => $parentSubjectList
    ]) ?>

</div>
