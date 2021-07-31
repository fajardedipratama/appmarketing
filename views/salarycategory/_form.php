<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-category-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body"><div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'role')->dropDownList(
            ['Fixed'=>'Fixed','Additional'=>'Additional']); ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'jenis')->dropDownList(
            ['Pendapatan'=>'Pendapatan','Potongan'=>'Potongan']); ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'status')->dropDownList(
            ['Aktif'=>'Aktif','Nonaktif'=>'Nonaktif']); ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
    </div>
    </div></div></div>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
