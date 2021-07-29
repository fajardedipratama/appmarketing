<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalaryEmployee */

$this->title = 'Create Salary Employee';
$this->params['breadcrumbs'][] = ['label' => 'Salary Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salary-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
