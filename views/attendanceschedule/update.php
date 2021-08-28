<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AttendanceSchedule */

$this->title = 'Update Attendance Schedule: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attendance Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attendance-schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
