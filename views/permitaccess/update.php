<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermitAccess */

$this->title = 'Update Data Akses';
?>
<div class="permit-access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
