<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offer Numbers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-number-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Offer Number', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nomor',
            'inisial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
