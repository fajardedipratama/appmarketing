<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Permit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'karyawan_id')->textInput() ?>

    <?= $form->field($model, 'kategori')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_izin')->textInput() ?>

    <?= $form->field($model, 'jam_masuk')->textInput() ?>

    <?= $form->field($model, 'jam_keluar')->textInput() ?>

    <?= $form->field($model, 'alasan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
