<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OfferNumber */

$this->title = 'Update Offer Number: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Offer Numbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="offer-number-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
