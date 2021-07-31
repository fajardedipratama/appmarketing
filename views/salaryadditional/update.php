<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryAdditional */

$this->title = 'Update Salary Additional: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Salary Additionals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salary-additional-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
