<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
use app\models\Dailyreport;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Perusahaan';

?>
<div class="customer-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
        <?php if(Yii::$app->user->identity->type != 'Marketing'): ?>
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
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
                        return '<i class="fa fa-fw fa-check"></i>';
                    }elseif($model->verified == 'no'){
                        return '<i class="fa fa-fw fa-remove"></i>';
                    }
                },
                'filter'=> ['yes'=>'yes','no'=>'no']
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
                'value' => 'karyawan.nama_pendek',
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'sales','data'=>$sales,
                    'options'=>['placeholder'=>'Sales'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            [
                'header'=>'Status Terakhir',
                'value'=>function($model){
                    $query = Dailyreport::find()->where(['perusahaan'=>$model->id])->orderBy(['waktu'=>SORT_DESC])->one();
                    if($query){
                        return $query['keterangan'].'-'.date('d/m/y',strtotime($query['waktu']));;
                    }
                }
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
              ])
            ],
            [
                'class' => 'yii\grid\ActionColumn','header'=>'Aksi',
                'template' => '{view} {update} {assign}',
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
                'visible' => Yii::$app->user->identity->type == 'Administrator' || Yii::$app->user->identity->type == 'Manajemen'
            ],
        ],
    ]); ?>
</div></div></div>

</div>
