<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use dosamigos\datepicker\DatePicker;
use app\models\Karyawan;

$this->title = 'Ex-Karyawan';

/* @var $this yii\web\View */
/* @var $model app\models\Exkaryawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exkaryawan-form">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body">
    <div class="row">
    	<?= $form->field($model2, 'id_employee')->hiddenInput(['value'=>$model->id,'readonly'=>true])->label(false) ?>
    	<div class="col-sm-4">
    		<?= $form->field($model, 'nama_karyawan')->textInput(['value'=>$model->nama,'readonly'=>true]) ?>
    	</div>
    	<div class="col-sm-4">
    		<?= $form->field($model2, 'alasan')->textarea(['style' => 'resize:none','rows' => 3]) ?>
    	</div>
    	<div class="col-sm-3">
    		<?php 
                if(!$model2->isNewRecord || $model2->isNewRecord){
                    if($model2->tgl_resign!=null){
                        $model2->tgl_resign=date('d-m-Y',strtotime($model2->tgl_resign));
                    }
                }
            ?>
            <?= $form->field($model2, 'tgl_resign')->widget(DatePicker::className(),[
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
