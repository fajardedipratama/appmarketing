<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KasDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kas-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kas_id')->textInput() ?>

    <?= $form->field($model, 'akun_id')->textInput() ?>

    <?= $form->field($model, 'tgl_kas')->textInput() ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'titip')->textInput() ?>

    <?= $form->field($model, 'saldo_akhir')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
