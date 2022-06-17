<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\grid\GridView;
use app\models\Customer;
use app\models\Karyawan;
use dosamigos\datepicker\DatePicker;
use app\models\PurchaseOrder;
$this->title = 'Gabung Customer';
/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mergeoffer-view">

<div class="row">
    <div class="col-sm-9">
        <h1>
            <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['/offer'], ['class' => 'btn btn-success']) ?>
            <?= Html::encode($this->title) ?>
        </h1>
    </div>
    <div class="col-sm-3">
        <?= Html::a('<i class="fa fa-fw fa-eye"></i> Lihat Profil', ['view','id'=>$model->id], ['class' => 'btn btn-success']) ?>
        <button class="btn btn-danger" data-toggle="modal" data-target="#print-detail"><i class="fa fa-fw fa-trash"></i> Hapus Data</button>
    </div>
</div>
<h4><?= $model->perusahaan.' - '.$model->karyawan->nama_pendek ?></h4>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'verified',
                'headerOptions'=>['style'=>'width:6%'],
                'format'=>'raw',
                'value'=>function($model){
                    $query = PurchaseOrder::find()->where(['perusahaan'=>$model->id])->andWhere(['status'=>['Terkirim','Terbayar-Selesai']])->count();
                    if($query>0){
                        if($model->verified == 'yes'){
                            return '<i class="fa fa-fw fa-check" title="Disetujui"></i> <i class="fa fa-fw fa-lock" title="PO"></i>';
                        }elseif($model->verified == 'no'){
                            return '<i class="fa fa-fw fa-remove" title="Ditolak"></i> <i class="fa fa-fw fa-lock" title="PO"></i>';
                        }elseif($model->verified == 'black'){
                            return '<i class="fa fa-fw fa-ban" title="Blacklist"></i> <i class="fa fa-fw fa-lock" title="PO"></i>';
                        }
                    }else{
                        if($model->verified == 'yes'){
                            return '<i class="fa fa-fw fa-check" title="Disetujui"></i>';
                        }elseif($model->verified == 'no'){
                            return '<i class="fa fa-fw fa-remove" title="Ditolak"></i>';
                        }elseif($model->verified == 'black'){
                            return '<i class="fa fa-fw fa-ban" title="Blacklist"></i>';
                        }
                    }
                },
                'filter'=> ['yes'=>'yes','no'=>'no','black'=>'black']
            ],
            'perusahaan',
            [
                'attribute' => 'lokasi',
                'value' => 'city.kota',
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'lokasi','data'=>$kota,
                    'options'=>['placeholder'=>'Lokasi'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            [
                'attribute' => 'sales',
                'value' => function($model){
                    if(Yii::$app->user->identity->type != 'Marketing'){
                        if ($model->sales) {
                            return $model->karyawan->nama_pendek;
                        }else{
                            return " ";
                        }
                    }else{
                        if ($model->sales) {
                            if($model->sales == 2){
                                return " ";
                            }else{
                                return $model->karyawan->nama_pendek;
                            }
                        }else{
                            return " ";
                        }
                    }
                },
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'sales','data'=>$sales,
                    'options'=>['placeholder'=>'Sales'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            [
              'header'=>'Expired',
              'value' => 'expired',
              'headerOptions'=>['style'=>'width:10%'],
              'format' => ['date', 'dd-MM-Y'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'expired','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ]),
              'visible' => Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Gabung',
                'template'=>'{merge}',
                'buttons'=>
                [
                    'merge'=>function($url,$model)
                    {
                        return Html::a('Gabung', ['customer/mergeoffer','source'=>$_GET['id'],'target' =>$model->id], [
                            'class' => 'btn btn-xs btn-success',
                            'target' => '_blank',
                            'data' => [
                                'confirm' => 'Gabung Data ?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn','header'=>'Detail',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div></div></div>

</div>
