<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCalculate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-calculate-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'bulan')->textInput(['type'=>'number','min'=>1,'max'=>12]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'tahun')->textInput(['type'=>'number']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
