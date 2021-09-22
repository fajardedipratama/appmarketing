<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Permit */

$this->title = 'Tambah Cuti & Izin';

?>
<div class="permit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
