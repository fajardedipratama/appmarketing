<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Penawaran '.$model->no_surat;
?>
<div class="offer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
