<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrderFile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-file-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelfile, 'penerima')->textInput(['maxlength' => true,'value'=>ucwords(strtolower($model->purchasing)).' - '.$model->no_purchasing]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelfile, 'berkas')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($modelfile, 'alamat')->textInput(['maxlength' => true,'value'=>ucwords(strtolower($model->alamat))]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
