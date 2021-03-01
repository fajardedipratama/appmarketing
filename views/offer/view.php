<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Detail Penawaran';
\yii\web\YiiAsset::register($this);
?>
<div class="offer-view">
    <div class="row">
        <div class="col-sm-8">
            <h1>Detail Penawaran</h1>
        </div>
        <div class="col-sm-4">
            <p>
                <?= Html::a('<i class="fa fa-fw fa-list"></i> Data', ['index'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Hapus data ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tanggal',
            'waktu',
            'no_surat',
            [
              'attribute'=>'perusahaan',
              'value'=>function($data){
                return $data->customer->perusahaan;
              },
            ],
            'pic',
            'top',
            'pajak',
            'harga',
            'catatan',
            [
              'attribute'=>'sales',
              'value'=>function($data){
                return $data->karyawan->nama;
              },
            ],
            'status',
        ],
    ]) ?>   
    </div>
</div>
