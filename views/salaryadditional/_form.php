<?php
use app\models\SalaryCategory;
use app\models\Karyawan;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\SalaryAdditional */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salary-additional-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body"><div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'karyawan_id')->widget(Select2::className(),[
            'data'=>ArrayHelper::map(Karyawan::find()->where(['status_aktif'=>'Aktif'])->orderBy(['nama'=>SORT_ASC])->all(),'id',
                function($model){
                    return $model['nama_pendek'];
                }
            ),
            'options'=>['placeholder'=>"Karyawan"],'pluginOptions'=>['allowClear'=>true]
        ]) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'komponen_id')->dropDownList(
            ArrayHelper::map(SalaryCategory::find()->where(['role'=>'Additional'])->all(),'id',
                function($model){
                    return $model['nama'];
                }
        )); ?>
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
    <div class="col-sm-4">
        <?= $form->field($model, 'nilai')->textInput(['type'=>'number']) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'catatan')->textInput(['maxlength' => true]) ?>
    </div>
    </div></div></div>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
