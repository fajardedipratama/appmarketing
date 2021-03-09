<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\City;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="selfcustomer-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="box box-success"><div class="box-body">
    <div class="row">
     <div class="col-sm-4">
        <?= $form->field($model, 'perusahaan')->textInput(['maxlength' => true])->hint("Contoh penulisan : BERDIKARI JAYA BERSAMA PT") ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'lokasi')->widget(Select2::className(),[
            'data'=>ArrayHelper::map(City::find()->orderBy(['kota'=>SORT_ASC])->all(),'id',
                function($model){
                    return $model['kota'];
                }
            ),
            'options'=>['placeholder'=>"Lokasi"],'pluginOptions'=>['allowClear'=>true]
        ]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'alamat_lengkap')->textInput(['maxlength' => true]) ?>
     </div>
    </div>
    <div class="row">
     <div class="col-sm-4">
        <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'telfon')->textInput(['maxlength' => true]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'volume')->textInput(['type' => 'number','min'=>5,'max'=>1000]) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'jarak_ambil')->dropDownList(['Setiap 1-3 Minggu'=>'Setiap 1-3 Minggu','Setiap 1 Bulan'=>'Setiap 1 Bulan','Setiap 2-5 bulan'=>'Setiap 2-5 bulan','Setiap 6-12 bulan'=>'Setiap 6-12 bulan'],['prompt'=>'--Jarak Kebutuhan--']) ?>
     </div>
     <div class="col-sm-4">
        <?= $form->field($model, 'catatan')->textInput(['maxlength' => true]) ?>
     </div>
     <div class="col-sm-4">
    <?php if(Yii::$app->user->identity->type != 'Marketing'): ?>
        <?= $form->field($model, 'sales')->widget(Select2::className(),[
            'data'=>ArrayHelper::map(Karyawan::find()->where(['posisi'=>6,'status_aktif'=>'Aktif'])->orderBy(['nama'=>SORT_ASC])->all(),'id',
                function($model){
                    return $model['nama'];
                }
            ),
            'options'=>['placeholder'=>"Sales"],'pluginOptions'=>['allowClear'=>true]
        ]) ?>
    <?php else: ?>
        <?= $form->field($model, 'sales')->hiddenInput(['value'=>Yii::$app->user->identity->profilname,'readonly'=>true])->label(false); ?>
    <?php endif; ?>
     </div>
    </div>
</div></div>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Batal', ['selfcustomer/view','id'=>$model->id], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
