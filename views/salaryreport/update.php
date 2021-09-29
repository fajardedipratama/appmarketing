<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryReport */

$this->title = 'Update Detail Laporan';
?>
<div class="salary-report-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5><?= 'Periode '.date('F',strtotime($model->bulan)).'-'.$model->tahun ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
