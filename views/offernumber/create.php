<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OfferNumber */

$this->title = 'Create Offer Number';
$this->params['breadcrumbs'][] = ['label' => 'Offer Numbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-number-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
