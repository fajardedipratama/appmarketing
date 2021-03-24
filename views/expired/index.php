<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExpiredSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Expired';
?>
<div class="customer-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('<i class="fa fa-fw fa-institution"></i> Data Perusahaan', ['customer/index'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

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
                    if($model->verified == 'yes'){
                        return '<i class="fa fa-fw fa-check" title="Disetujui"></i>';
                    }elseif($model->verified == 'no'){
                        return '<i class="fa fa-fw fa-remove" title="Ditolak"></i>';
                    }
                },
                'filter'=> ['yes'=>'yes','no'=>'no']
            ],
            'perusahaan',
            [
                'attribute' => 'sales',
                'value' => 'karyawan.nama_pendek',
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'sales','data'=>$sales,
                    'options'=>['placeholder'=>'Sales'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            [
              'header'=>'Expired',
              'value' => 'expired',
              'headerOptions'=>['style'=>'width:13%'],
              'format' => ['date', 'dd-MM-Y'],
              'filter'=> DatePicker::widget([
                'model'=>$searchModel,'attribute'=>'expired','clientOptions'=>[
                  'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                ],
              ]),
            ],
            [
                'header'=>'+2 Minggu ?',
                'attribute'=>'long_expired',
                'headerOptions'=>['style'=>'width:6%'],
                'format'=>'raw',
                'value'=>function($model){
                    if($model->long_expired == 'yes'){
                        return '<i class="fa fa-fw fa-warning" title="Pernah Diperpanjang"></i>';
                    }
                },
                'filter'=> ['yes'=>'yes']
            ],

            [
                'class' => 'yii\grid\ActionColumn','header'=>'Aksi',
                'template' => '{assign}',
                'buttons'=>
                [
                    'assign'=>function($url,$model)
                    {
                    return Html::a
                     (
                        '<span class="glyphicon glyphicon-share"></span>',
                        ["customer/share",'id'=>$model->id],
                        ['title' => Yii::t('app', 'Sebarkan')],
                     );
                    },

                ],
            ],
        ],
    ]); ?>
</div></div></div>

</div>
