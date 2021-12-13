<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KasAkun */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kas-akun-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="box box-success"><div class="box-body">
<div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'kode')->textInput() ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'kategori')->textInput(['maxlength' => true]) ?>
    </div>
</div>
</div></div>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
