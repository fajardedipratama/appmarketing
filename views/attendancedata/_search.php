<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\AttendancedataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'karyawan_id') ?>

    <?= $form->field($model, 'work_day') ?>

    <?= $form->field($model, 'work_date') ?>

    <?= $form->field($model, 'schedule_in') ?>

    <?php // echo $form->field($model, 'schedule_out') ?>

    <?php // echo $form->field($model, 'real_in') ?>

    <?php // echo $form->field($model, 'real_out') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
