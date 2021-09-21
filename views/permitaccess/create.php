<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermitAccess */

$this->title = 'Tambah Akses';
?>
<div class="permit-access-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
