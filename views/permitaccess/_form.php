<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Karyawan;
/* @var $this yii\web\View */
/* @var $model app\models\PermitAccess */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permit-access-form">

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
        <?= $form->field($model, 'tipe_akses')->dropDownList(['Personalia'=>'Personalia','Ka.Cabang Sby'=>'Ka.Cabang Sby']) ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'tanda_tangan')->fileInput(); ?>
            <?php if(!$model->isNewRecord): ?>
                <small>*Jika tidak ada perubahan foto, kosongi field ini</small>
            <?php endif; ?>
    </div>
    </div></div></div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
