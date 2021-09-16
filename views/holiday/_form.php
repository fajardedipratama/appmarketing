<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Holiday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holiday-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body"><div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'nama_hari')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?php 
                if(!$model->isNewRecord || $model->isNewRecord){
                    if($model->tanggal!=null){
                        $model->tanggal=date('d-m-Y',strtotime($model->tanggal));
                    }
                }
            ?>
            <?= $form->field($model, 'tanggal')->widget(DatePicker::className(),[
                'clientOptions'=>[
                    'autoclose'=>true,
                    'format'=>'dd-mm-yyyy',
                    'orientation'=>'bottom',
                ]
            ])?>
        </div>
    </div></div></div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
