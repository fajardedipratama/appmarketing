<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\DailyreportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dailyreport-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sales') ?>

    <?= $form->field($model, 'waktu') ?>

    <?= $form->field($model, 'perusahaan') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'jarak_ambil') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'pengingat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
