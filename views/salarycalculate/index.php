<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan';

?>
<div class="salary-calculate-index">

    <div class="row">
        <div class="col-sm-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <button class="btn btn-success" data-toggle="modal" data-target="#create-new"><i class="fa fa-fw fa-plus-square"></i> Tambah Data</button>
        </div>
    </div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute'=>'bulan',
                'value'=>function($data){
                    return date('F', mktime(0, 0, 0, $data->bulan));
                }
            ],
            'tahun',
            [
                'header'=>'Tanggal PO',
                'value'=>function($data){
                return date('d/m/Y',strtotime($data->begin_date)).' - '.date('d/m/Y',strtotime($data->end_date));
                }
            ],
            [
                'header'=>'Tanggal Absensi',
                'value'=>function($data){
                    if($data->begin_absen != NULL){
                return date('d/m/Y',strtotime($data->begin_absen)).' - '.date('d/m/Y',strtotime($data->end_absen));
                    }
                }
            ],
            ['header'=>'Aksi','class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>
</div></div></div>

    <div class="modal fade" id="create-new"><div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Tambah Data</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div></div>

</div>
