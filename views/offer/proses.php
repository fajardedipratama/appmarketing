<?php
use app\models\City;
use app\models\Karyawan;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penawaran Proses';

?>
<div class="offer-index">

  <h1><?= Html::encode($this->title) ?></h1>

  <div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
              'header'=>'SendToWA',
              'format'=>'raw',
              'headerOptions'=>['style'=>'width:8%'],
              'value'=>function($data){
                if($data->send_wa === 1){
                  return '<i class="fa fa-fw fa-check"></i>';
                }else{
                  return ' ';
                }
              }
            ],
            [
              'header'=>'Email',
              'format' => 'email',
              'value'=>'customer.email',
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
              'class' => 'yii\grid\ActionColumn',
              'headerOptions'=>['style'=>'width:8%'],
              'header'=>'Status',
              'template' => '{terkirim} {gagal}',
                'buttons'=>
                [
                    'terkirim'=>function($url,$model)
                    {
                    return Html::a
                     (
                        '<span class="glyphicon glyphicon-ok"></span>',
                        ["offer/success",'id'=>$model->id],
                        ['title' => Yii::t('app', 'Terkirim')],
                     );
                    },
                    'gagal'=>function($url,$model)
                    {
                    return Html::a
                     (
                        '<span class="glyphicon glyphicon-remove"></span>',
                        ["offer/failed",'id'=>$model->id],
                        ['title' => Yii::t('app', 'Gagal')],
                     );
                    },
                ],
                'visible' => Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
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
