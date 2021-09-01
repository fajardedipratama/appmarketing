<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AttendanceData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-data-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'real_in')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'real_out')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['name'=>'simpan','class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
