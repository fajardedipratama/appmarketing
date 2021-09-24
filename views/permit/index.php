<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PermitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuti & Izin';

?>
<div class="permit-index">

    <div class="row">
        <div class="col-sm-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-4">
            <?= Html::a('<i class="fa fa-fw fa-plus-square"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
            <button class="btn btn-warning" data-toggle="modal" data-target="#searchreport"><i class="fa fa-fw fa-print"></i> Laporan</button>
            <?= Html::a('<i class="fa fa-fw fa-key"></i> User Akses', ['/permitaccess'], ['class' => 'btn btn-danger']) ?>
        <?php endif; ?>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'karyawan_id',
                'value'=>'karyawan.nama',
                'filter'=>\kartik\select2\Select2::widget([
                    'model'=>$searchModel,'attribute'=>'karyawan_id','data'=>$karyawan,
                    'options'=>['placeholder'=>'Karyawan'],'pluginOptions'=>['allowClear'=>true]
                ])
            ],
            [
                'attribute'=>'tgl_mulai',
                'format' => ['date','dd-MM-Y'],
                'headerOptions'=>['style'=>'width:15%'],
                'filter'=> DatePicker::widget([
                    'model'=>$searchModel,'attribute'=>'tgl_mulai','clientOptions'=>[
                      'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                    ],
                ]),
            ],
            [
                'attribute'=>'tgl_selesai',
                'format' => ['date','dd-MM-Y'],
                'headerOptions'=>['style'=>'width:15%'],
                'filter'=> DatePicker::widget([
                    'model'=>$searchModel,'attribute'=>'tgl_selesai','clientOptions'=>[
                      'autoclose'=>true, 'format' => 'dd-mm-yyyy','orientation'=>'bottom'
                    ],
                ]),
            ],
            [
                'attribute'=>'kategori',
                'filter'=> ['Sakit'=>'Sakit','Izin Cuti'=>'Izin Cuti','Terlambat'=>'Terlambat','Pulang Awal'=>'Pulang Awal','Keluar Kantor'=>'Keluar Kantor']
            ],
            [
                'attribute'=>'status',
                'filter'=> ['Pending'=>'Pending','Konfirmasi-HRD'=>'Konfirmasi-HRD','Terverifikasi'=>'Terverifikasi']
            ],
            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>
</div></div></div>

<!-- modal -->
    <div class="modal fade" id="searchreport">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Tanggal</b></h4>          
        </div>
        <div class="modal-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'set_awal')->widget(DatePicker::className(),[
                    'clientOptions'=>['autoclose'=>true,'format'=>'dd-mm-yyyy','orientation'=>'bottom']
                    ])?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'set_akhir')->widget(DatePicker::className(),[
                    'clientOptions'=>['autoclose'=>true,'format'=>'dd-mm-yyyy','orientation'=>'bottom']
                    ])?>
                </div>
            </div>
            <?= Html::submitButton('Cari', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
    </div>
<!-- modal -->

</div>
