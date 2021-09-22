<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $model app\models\Permit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body"><div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'karyawan_id')->widget(Select2::className(),[
            'data'=>ArrayHelper::map(Karyawan::find()->orderBy(['nama'=>SORT_ASC])->where(['status_aktif'=>'Aktif'])->all(),'id',
                function($model){
                    return $model['nama_pendek'];
                }
            ),
            'options'=>['placeholder'=>"Karyawan"],'pluginOptions'=>['allowClear'=>true]
        ]) ?>
    </div>
    <div class="col-sm-4">    
        <?= $form->field($model, 'kategori')->dropDownList(['Sakit'=>'Sakit','Izin Cuti'=>'Izin Cuti','Terlambat'=>'Terlambat','Pulang Awal'=>'Pulang Awal','Keluar Kantor'=>'Keluar Kantor']) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'alasan')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-4">
        <?php 
            if(!$model->isNewRecord || $model->isNewRecord){
                if($model->tgl_izin!=null){
                    $model->tgl_izin=date('d-m-Y',strtotime($model->tgl_izin));
                }
            }
        ?>
        <?= $form->field($model, 'tgl_izin')->widget(DatePicker::className(),[
            'clientOptions'=>['autoclose'=>true,'format'=>'dd-mm-yyyy','orientation'=>'bottom']
        ])?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'jam_masuk')->textInput(['type'=>'time']) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'jam_keluar')->textInput(['type'=>'time']) ?>
    </div>
    </div></div></div>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
