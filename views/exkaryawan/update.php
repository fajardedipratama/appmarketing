<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exkaryawan */

$this->title = 'Update Exkaryawan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exkaryawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exkaryawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
