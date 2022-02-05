<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PurchasereviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Review PO';
?>
<div class="purchase-review-index">

    <h1>
        <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['/purchaseorder'], ['class' => 'btn btn-success']) ?>
        <?= Html::encode($this->title) ?>
    </h1>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'perusahaan',
            [
                'attribute'=>'sales',
                'value'=>function($data){
                    if($data->sales === 2){
                        return '-';
                    }else{
                        return $data->karyawan->nama_pendek;
                    }
                }
            ],
            [
                'header'=>'Aksi','class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
            ],
        ],
    ]); ?>
</div></div></div>

</div>
