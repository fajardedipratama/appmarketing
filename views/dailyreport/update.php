<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dailyreport */

$this->title = 'Update Dailyreport: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dailyreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dailyreport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
