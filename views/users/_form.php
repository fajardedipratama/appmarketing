<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'profilname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'password')->passwordInput(['value'=>'','maxlength' => true]) ?>
                <?php if(!$model->isNewRecord): ?>
                   <?= Html::hiddenInput('oldps', $model->password); ?>
                   <small>*jika tidak ada perubahan password, kosongkan field ini</small>
                <?php endif; ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'type')->dropDownList(['Administrator'=>'Administrator','Manajemen'=>'Manajemen','Marketing'=>'Marketing'],['prompt'=>'--Tipe User--']) ?>
            </div>
        </div>
    </div></div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
