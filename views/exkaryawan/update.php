<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exkaryawan */

$this->title = 'Update Ex-karyawan';
?>
<div class="exkaryawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
