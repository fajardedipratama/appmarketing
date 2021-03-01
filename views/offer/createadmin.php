<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
$this->title = 'Penawaran Baru';

?>
<div class="offer-create">

    <h1><b><?= Html::encode($this->title) ?></b></h1>

    <?= $this->render('_formadmin', [
        'model' => $model,
    ]) ?>

</div>
