<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KasAkun */

$this->title = 'Ubah Akun #' . $model->kode;
?>
<div class="kas-akun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
