<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="box box-success"><div class="box-body">
    <div class="row">
    <?= $form->field($model, 'sales')->hiddenInput(['value'=>$customer->sales,'readonly'=>true])->label(false) ?>
    <?= $form->field($model, 'perusahaan')->hiddenInput(['value'=>$customer->id,'readonly'=>true])->label(false) ?>
     <div class="col-sm-4">
        <?= $form->field($model, 'pic')->textInput(['maxlength' => true,'value'=>$customer->pic,]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'top')->dropDownList(['Cash On Delivery'=>'Cash On Delivery','Cash Before Delivery'=>'Cash Before Delivery','Tempo 7 Hari'=>'Tempo 7 Hari','Tempo 14 Hari'=>'Tempo 14 Hari','Tempo 21 Hari'=>'Tempo 21 Hari','Tempo 30 Hari'=>'Tempo 30 Hari']) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'pajak')->dropDownList(['PPN'=>'PPN','Non PPN'=>'Non PPN']) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'harga')->textInput(['type'=>'number','min'=>1000,'max'=>50000]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'catatan')->textInput(['maxlength' => true]) ?>
     </div>
    </div>
</div></div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Batal', ['selfcustomer/view','id'=>$customer->id], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
