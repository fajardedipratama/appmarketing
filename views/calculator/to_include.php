<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'DPP -> Indlude Tax';
?>
<div class="calculator-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success"><div class="box-body">
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'dpp_value')->textInput(['type' => 'number']) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Hitung', ['class' => 'btn btn-success']) ?>
    </div>
    </div></div>
    <?php ActiveForm::end(); ?>

</div>
