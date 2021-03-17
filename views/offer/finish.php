<?php
use app\models\City;
use app\models\Karyawan;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penawaran Selesai';

?>
<div class="offer-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
        <?php if(Yii::$app->user->identity->type != 'Marketing'): ?>
            <?= Html::a('<i class="fa fa-fw fa-file-excel-o"></i> Export Excel', ['export-excel2'], ['class'=>'btn btn-success']); ?>
        <?php endif ?> 
        </div>
    </div>

  <div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'tanggal',
              'value' => 'tanggal',
              'headerOptions'=>['style'=>'width:15%'],
              'format' => ['date','dd-MM-Y'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'tanggal','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ])
            ],
            [
              'attribute'=>'no_surat',
              'headerOptions'=>['style'=>'width:8%'],
            ],
            [
              'attribute'=>'perusahaan',
              'value'=>'customer.perusahaan',
              'filter'=>\kartik\select2\Select2::widget([
                'model'=>$searchModel,'attribute'=>'perusahaan','data'=>$customer,
                'options'=>['placeholder'=>'Perusahaan'],'pluginOptions'=>['allowClear'=>true]
              ])
            ],
            [
              'header'=>'Lokasi',
              'value'=>function($data){
                $query = City::find()->where(['id'=>$data->customer->lokasi])->one();
                return $query['kota'];
              }
            ],
            [
              'attribute'=>'sales',
              'value' => 'karyawan.nama_pendek',
              'filter'=>\kartik\select2\Select2::widget([
                'model'=>$searchModel,'attribute'=>'sales','data'=>$sales,
                'options'=>['placeholder'=>'Sales'],'pluginOptions'=>['allowClear'=>true]
              ])
            ],
            [
              'attribute' => 'status',
              'filter'=> ['Terkirim'=>'Terkirim','Gagal Kirim'=>'Gagal Kirim']
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'headerOptions'=>['style'=>'width:8%'],
              'header'=>'Aksi',
              'template' => '{view} {cetak}',
              'buttons'=>
              [
                'view'=>function($url,$model)
                {
                  return Html::a
                  (
                    '<span class="glyphicon glyphicon-eye-open"></span>',
                    ["offer/view",'id'=>$model->id],
                    ['title' => Yii::t('app', 'View'),'target'=>'_blank'],
                  );
                },
                'cetak'=>function($url,$model)
                {
                  return Html::a
                  (
                    '<span class="glyphicon glyphicon-print"></span>',
                    ["offer/print",'id'=>$model->id],
                    ['title' => Yii::t('app', 'Print'),'target'=>'_blank'],
                  );
                },
              ],
              'visibleButtons'=>
              [
                'cetak'=>function($model){
                  return Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen';
                }
              ]
            ],
        ],
    ]); ?>
  </div></div></div>

</div>
