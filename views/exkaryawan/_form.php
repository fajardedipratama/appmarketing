<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exkaryawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exkaryawan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'badge')->textInput() ?>

    <?= $form->field($model, 'alasan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_resign')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
