<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $modelprogress app\models\Dailyreport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dailyreport-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($modelprogress, 'sales')->hiddenInput(['value'=>$model->sales,'readonly'=>true])->label(false) ?>
        <?= $form->field($modelprogress, 'perusahaan')->hiddenInput(['value'=>$model->id,'readonly'=>true])->label(false) ?>
     <div class="col-sm-4">
        <?= $form->field($modelprogress, 'keterangan')->dropDownList(
              ['Penawaran'=>'Penawaran','Belum ada kebutuhan'=>'Belum ada kebutuhan','Tidak diangkat'=>'Tidak diangkat','PIC sibuk'=>'PIC sibuk','Tidak pakai solar'=>'Tidak pakai solar','Kebutuhan <5KL'=>'Kebutuhan <5KL','Kontrak vendor lain'=>'Kontrak vendor lain','Kalah harga'=>'Kalah harga'],
              ['prompt'=>'--keterangan--']); ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($modelprogress, 'volume')->textInput(['type' => 'number','min'=>5,'max'=>1000]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($modelprogress, 'jarak_ambil')->dropDownList(['<1bulan sekali'=>'<1bulan sekali','1bulan sekali'=>'1bulan sekali','>1bulan sekali'=>'>1bulan sekali'],['prompt'=>'--Jarak Kebutuhan--']) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($modelprogress, 'catatan')->textInput(['maxlength' => true]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($modelprogress, 'con_used')->dropDownList(['Telfon Kantor'=>'Telfon Kantor','WA Pribadi'=>'WA Pribadi']) ?>
     </div>
     <div class="col-sm-4">
        <?php 
            if(!$modelprogress->isNewRecord || $modelprogress->isNewRecord){
                if($modelprogress->pengingat!=null){
                    $modelprogress->pengingat=date('d-m-Y',strtotime($modelprogress->pengingat));
                }
            }
        ?>
        <?= $form->field($modelprogress, 'pengingat')->widget(DatePicker::className(),[
            'clientOptions'=>[
                'autoclose'=>true,
                'format'=>'dd-mm-yyyy',
                'orientation'=>'bottom',
            ]
        ])?>
     </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
