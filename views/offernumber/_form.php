<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OfferNumber */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor')->textInput() ?>

    <?= $form->field($model, 'inisial')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
