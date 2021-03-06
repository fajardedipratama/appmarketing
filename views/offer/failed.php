<?php
use app\models\City;
use app\models\Karyawan;
use app\models\Offernumber;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penawaran Gagal';

?>
<div class="offer-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
          <?= Html::a('<i class="fa fa-fw fa-list"></i> Data Sales', ['selfcustomer/index'], ['class' => 'btn btn-success']) ?>
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
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Aksi',
              'headerOptions'=>['style'=>'width:8%'],
              'template' => '{view}',
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
                ],
            ],
        ],
    ]); ?>
  </div></div></div>

</div>
