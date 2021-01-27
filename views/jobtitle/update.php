<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jobtitle */

$this->title = 'Update Jobtitle: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jobtitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jobtitle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
