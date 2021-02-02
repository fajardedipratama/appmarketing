<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exkaryawan */

$this->title = 'Create Exkaryawan';
$this->params['breadcrumbs'][] = ['label' => 'Exkaryawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exkaryawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
