<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use dosamigos\datepicker\DatePicker;
use app\models\Karyawan;

$karyawan = Karyawan::find()->where(['badge'=>$model->badge])->one();

/* @var $this yii\web\View */
/* @var $model app\models\Exkaryawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exkaryawan-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body">
    <div class="row">
        <div class="col-sm-1">
        <?php if($karyawan): ?>
    		<?= $form->field($model, 'badge')->textInput(['value'=>$karyawan['badge'],'readonly'=>true]) ?>
    	<?php else: ?>
    		<?php  throw new NotFoundHttpException('The requested page does not exist.'); ?>
    	<?php endif; ?>
    	</div>
    	<div class="col-sm-4">
    		<?= $form->field($model, 'nama_karyawan')->textInput(['value'=>$karyawan['nama'],'readonly'=>true]) ?>
    	</div>
    	<div class="col-sm-4">
    		<?= $form->field($model, 'alasan')->textarea(['style' => 'resize:none','rows' => 3]) ?>
    	</div>
    	<div class="col-sm-3">
    		<?php 
                if(!$model->isNewRecord || $model->isNewRecord){
                    if($model->tgl_resign!=null){
                        $model->tgl_resign=date('d-m-Y',strtotime($model->tgl_resign));
                    }
                }
            ?>
            <?= $form->field($model, 'tgl_resign')->widget(DatePicker::className(),[
                'clientOptions'=>[
                    'autoclose'=>true,
                    'format'=>'dd-mm-yyyy',
                    'orientation'=>'bottom',
                ]
            ])?>
    	</div>
    </div>
	</div></div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', [
        	'class' => 'btn btn-success',
        	'data' => ['confirm' => 'Apakah anda yakin ingin menonaktifkan karyawan ini ?'],
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
