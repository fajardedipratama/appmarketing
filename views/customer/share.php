<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'Sebar '. $model->perusahaan;

?>
<div class="customer-update">

    <h2>Sebar <b><?= $model->perusahaan ?></b></h2>

    <?= $this->render('_formshare', [
        'model' => $model,
    ]) ?>

</div>
