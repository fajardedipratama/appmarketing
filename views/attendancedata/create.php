<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AttendanceData */

$this->title = 'Create Attendance Data';
$this->params['breadcrumbs'][] = ['label' => 'Attendance Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
