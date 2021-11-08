<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PurchasereviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Review PO';
?>
<div class="purchase-review-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'customer.perusahaan',
            'last_purchase_id',
            'customer.sales',
            'review_by',
            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div></div>

</div>
