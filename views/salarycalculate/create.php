<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryCalculate */

$this->title = 'Create Salary Calculate';
$this->params['breadcrumbs'][] = ['label' => 'Salary Calculates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salary-calculate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
