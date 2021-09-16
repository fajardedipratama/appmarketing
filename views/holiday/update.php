<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Holiday */

$this->title = 'Update ' . $model->nama_hari;
?>
<div class="holiday-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
