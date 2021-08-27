<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AttendanceData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'karyawan_id')->textInput() ?>

    <?= $form->field($model, 'work_day')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_date')->textInput() ?>

    <?= $form->field($model, 'schedule_in')->textInput() ?>

    <?= $form->field($model, 'schedule_out')->textInput() ?>

    <?= $form->field($model, 'real_in')->textInput() ?>

    <?= $form->field($model, 'real_out')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
