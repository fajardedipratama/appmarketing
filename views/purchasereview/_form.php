<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'perusahaan_id')->textInput() ?>

    <?= $form->field($model, 'last_purchase_id')->textInput() ?>

    <?= $form->field($model, 'sales_id')->textInput() ?>

    <?= $form->field($model, 'waktu_ambil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jarak_ambil')->textInput() ?>

    <?= $form->field($model, 'catatan_kirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan_berkas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan_lain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kendala')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'review_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
