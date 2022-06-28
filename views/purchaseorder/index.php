<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PurchaseorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data PO';

?>
<div class="purchase-order-index">

    <div class="row">
    <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
        <div class="col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-3">
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<i class="fa fa-fw fa-dollar"></i> Hasil PO', ['hasilpo','range'=>'all'],['class' => 'btn btn-danger']) ?>
        </div>
    <?php elseif(Yii::$app->user->identity->type == 'Manajemen'): ?>
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-dollar"></i> Hasil PO', ['hasilpo','range'=>'all'],['class' => 'btn btn-danger']) ?>
        </div>
    <?php else: ?>
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    <?php endif; ?>
    </div>


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
                //return $data->customer->perusahaan;
              },
              'filter'=>\kartik\select2\Select2::widget([
                'model'=>$searchModel,'attribute'=>'perusahaan','data'=>$customer,
                'options'=>['placeholder'=>'Perusahaan'],'pluginOptions'=>['allowClear'=>true]
              ])
            ],
            [
                'attribute' => 'kota_kirim',
                'value' => 'city.kota',
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'kota_kirim','data'=>$kota,
                    'options'=>['placeholder'=>'Kirim'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            [
              'attribute'=>'tgl_kirim',
              'value' => function($data){
                return $data->tgl_kirim;
              },
              'headerOptions'=>['style'=>'width:10%'],
              'format' => ['date','dd-MM-Y'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'tgl_kirim','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ])
            ],
            // [
            //   'attribute'=>'tgl_po',
            //   'value' => function($data){
            //     return $data->tgl_po;
            //   },
            //   'headerOptions'=>['style'=>'width:15%'],
            //   'format' => ['date','dd-MM-Y'],
            //   'filter'=> DatePicker::widget([
            //     'model'=>$searchModel,'attribute'=>'tgl_po','clientOptions'=>[
            //       'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
            //     ],
            //   ])
            // ],
            [
              'attribute'=>'jatuh_tempo',
              'value' => function($data){
                return $data->jatuh_tempo;
              },
              'headerOptions'=>['style'=>'width:10%'],
              'format' => ['date','dd-MM-Y'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'jatuh_tempo','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ])
            ],
            [
              'attribute'=>'termin',
              'filter'=> ['Cash On Delivery'=>'Cash On Delivery','Cash Before Delivery'=>'Cash Before Delivery','Tempo 7 Hari'=>'Tempo 7 Hari','Tempo 14 Hari'=>'Tempo 14 Hari','Tempo 21 Hari'=>'Tempo 21 Hari','Tempo 30 Hari'=>'Tempo 30 Hari']
            ],
            [
              'attribute'=>'volume',
              'headerOptions'=>['style'=>'width:5%'],
              'value'=>function($data){
                return $data->volume;
              }
            ],
            [
              'attribute'=>'sales',
              'value' => 'karyawan.nama_pendek',
              'filter'=>\kartik\select2\Select2::widget([
                'model'=>$searchModel,'attribute'=>'sales','data'=>$sales,
                'options'=>['placeholder'=>'Sales'],'pluginOptions'=>['allowClear'=>true]
              ]),
              'visible' => Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
            ],
            [
               'attribute'=>'status',
               'headerOptions'=>['style'=>'width:13%'],
               'filter'=> ['Pending'=>'Pending','Disetujui'=>'Disetujui','Ditolak'=>'Ditolak','Terkirim'=>'Terkirim','Batal Kirim'=>'Batal Kirim','Terbayar'=>'Terbayar']
            ],
            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>
</div></div></div>

</div>
