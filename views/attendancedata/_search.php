<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\search\AttendancedataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-data-search">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work_date')->widget(DatePicker::className(),[
        'clientOptions'=>[
        'autoclose'=>true,
        'format'=>'dd-mm-yyyy',
        'orientation'=>'bottom',
        ]
    ])?>
    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
