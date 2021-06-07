<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrderPaid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-paid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purchase_order_id')->textInput() ?>

    <?= $form->field($model, 'paid_date')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
