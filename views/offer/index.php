<?php
use app\models\City;
use app\models\Karyawan;
use app\models\OfferNumber;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penawaran Baru';

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
        <?php else: ?>
            <?= Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['index'], ['class' => 'btn btn-warning pull-right']) ?>
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
                  if ($data->customer->expired >= date('Y-m-d')) {
                    return $data->customer->perusahaan.'<i class="fa fa-fw fa-check"></i>';
                  }elseif($data->customer->expired == NULL){
                    return $data->customer->perusahaan.'<i class="fa fa-fw fa-check"></i>';
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
              'class' => 'yii\grid\ActionColumn',
              'headerOptions'=>['style'=>'width:8%'],
              'header'=>'Verif.',
              'template' => '{accept} {decline} {duplicate}',
              'buttons'=>
              [
                    'accept'=>function($url,$model)
                    {
                    return Html::a
                     (
                        '<span class="glyphicon glyphicon-ok"></span>',
                        ["offer/accept",'id'=>$model->id],
                        ['title' => Yii::t('app', 'Accept')],
                     );
                    },
                    'decline'=>function($url,$model)
                    {
                    return Html::a
                     (
                        '<span class="glyphicon glyphicon-remove"></span>',
                        ["offer/decline",'id'=>$model->id],
                        [
                          'title' => Yii::t('app', 'Decline'),
                          'data' => ['confirm' => 'Perusahaan ditolak ?','method' => 'post',]
                        ],
                     );
                    },
                    'duplicate'=>function($url,$model)
                    {
                    return Html::a
                     (
                        '<span class="glyphicon glyphicon-minus-sign"></span>',
                        ["offer/duplicate",'id'=>$model->id],
                        [
                          'title' => Yii::t('app', 'Duplicate Data!'),
                          'data' => ['confirm' => 'Perusahaan terdeteksi duplikat ?','method' => 'post',]
                        ],
                     );
                    },
                ],
                'visible' => Yii::$app->user->identity->type == 'Administrator'
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Aksi',
              'headerOptions'=>['style'=>'width:8%'],
              'template' => '{view} {update} {delete}',
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
              ],
              'visibleButtons'=>
              [
                'update'=>function($model){
                  return Yii::$app->user->identity->type == 'Administrator';
                },
                'delete'=>function($model){
                  return Yii::$app->user->identity->type == 'Administrator';
                }
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
