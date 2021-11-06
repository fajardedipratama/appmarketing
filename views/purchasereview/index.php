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
            [
              'attribute'=>'perusahaan',
              'format'=>'raw',
              'value'=>function($data){
                if($data->eksternal){
                  return '<i class="fa fa-fw fa-user-secret" title="Titipan"></i>'.$data->customer->perusahaan;
                }else{
                  return $data->customer->perusahaan;
                }
              },
              'filter'=>\kartik\select2\Select2::widget([
                'model'=>$searchModel,'attribute'=>'perusahaan','data'=>$customer,
                'options'=>['placeholder'=>'Perusahaan'],'pluginOptions'=>['allowClear'=>true]
              ])
            ],
            'review_by',

            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div></div>

</div>
