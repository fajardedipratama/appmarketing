<?php
use app\models\City;
use app\models\Offer;
use app\models\Karyawan;
use app\models\Customer;
use app\models\OfferNumber;
use app\models\PurchaseOrder;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penawaran';

?>
<div class="offer-index">

    <div class="row">
        <div class="col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-3">
        <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['createadmin'], ['class' => 'btn btn-success']) ?>
            <button class="btn btn-warning" data-toggle="modal" data-target="#offer-number"><i class="fa fa-fw fa-sort-numeric-asc"></i> No.Surat</button>
        <?php endif; ?>
        </div>
    </div>

  <div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'tanggal',
              'value' => function($data){
                return $data->tanggal.' '.$data->waktu;
              },
              'headerOptions'=>['style'=>'width:15%'],
              'format' => ['date','dd-MM-Y H:i'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'tanggal','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ])
            ],
            [
              'attribute'=>'perusahaan',
              'format'=>'raw',
              'value'=>function($data){
                if($data->customer->verified == 'yes'){
                  if ($data->customer->expired >= date('Y-m-d') || $data->customer->expired == NULL) {
                    $po = PurchaseOrder::find()->where(['perusahaan'=>$data->customer->id])->andWhere(['status'=>['Terkirim','Terbayar-Selesai']])->orderBy(['id'=>SORT_DESC])->one();
                    if($po){
                      return $data->customer->perusahaan.'<i class="fa fa-fw fa-check"></i><i class="fa fa-fw fa-truck" title="'.$po->tgl_kirim.'"></i> ';
                    }else{
                      return $data->customer->perusahaan.'<i class="fa fa-fw fa-check"></i>';
                    }
                  }elseif($data->customer->expired < date('Y-m-d')){
                    return $data->customer->perusahaan.'<i class="fa fa-fw fa-clock-o"></i>';
                  }
                }elseif($data->customer->verified == NULL){
                  return $data->customer->perusahaan.'<i class="fa fa-fw fa-hourglass-2"></i>';
                }
              },
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
              },
              'visible' => Yii::$app->user->identity->type != 'Administrator'
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
              'header'=>'Penawaran Terakhir',
              'headerOptions'=>['style'=>'width:10%'],
              'value'=>function($data){
                $query = Offer::find()->where(['perusahaan'=>$data->perusahaan])->orderBy(['id'=>SORT_DESC])->offset(1)->one();
                if($query){
                  return date('d/m/Y',strtotime($query['tanggal']));
                }
              },
              'visible' => Yii::$app->user->identity->type == 'Administrator'
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'header'=>'Gabung',
              'template'=> '{merge}',
              'buttons'=>
              [
                'merge'=>function($url,$model)
                {
                  if($model->customer->verified == NULL){
                    return Html::a('Gabung', ['customer/mergerequest','id'=>$model->perusahaan], ['class' => 'btn btn-xs btn-primary']);
                  }
                },
              ],
              'visible' => Yii::$app->user->identity->type == 'Administrator'
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'headerOptions'=>['style'=>'width:5%'],
              'header'=>'Verifikasi',
              'template' => '{accept}',
              'buttons'=>
              [
                    'accept'=>function($url,$model)
                    {
                      return Html::a('Proses', ["offer/accept",'id'=>$model->id], ['class' => 'btn btn-xs btn-success']);
                    },
                ],
                'visible' => Yii::$app->user->identity->type == 'Administrator'
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Detail',
              'headerOptions'=>['style'=>'width:5%'],
              'template' => '{view}',
              'buttons' => [
                'view'=>function($url,$model)
                {
                  return Html::a
                    (
                      '<i class="fa fa-fw fa-eye"></i>',
                      ["offer/view",'id'=>$model->id],
                      ['title' => Yii::t('app', 'View'),'target'=>'_blank'],
                    );
                },
                // 'duplicate'=>function($url,$model)
                // {
                //   return Html::a
                //      (
                //         '<span class="glyphicon glyphicon-minus-sign"></span>',
                //         ["offer/duplicate",'id'=>$model->id],
                //         [
                //           'title' => Yii::t('app', 'Duplicate Data!'),
                //           'data' => ['confirm' => 'Perusahaan terdeteksi duplikat ?','method' => 'post',],
                //         ],
                //      );
                // },
              ],
              'visibleButtons' => [
                    'duplicate' => function ($model) {
                        return Yii::$app->user->identity->type == 'Administrator';
                    },
              ]
            ],
        ],
    ]); ?>
  </div></div></div>

  <div class="modal fade" id="offer-number"><div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>No.Surat Penawaran</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formnumber', ['modelnumber' => $modelnumber]) ?>
            </div>
        </div>
    </div></div>

</div>
