<?php

use backend\form\ResourceForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Resource */
/* @var $form ResourceForm */

$this->title = 'Create Resource';
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'resource_form' => $form
    ]) ?>

</div>
