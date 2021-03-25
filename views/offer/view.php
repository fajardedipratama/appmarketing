<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = 'Detail Penawaran #'.$model->no_surat;
\yii\web\YiiAsset::register($this);
?>
<div class="offer-view">
    <div class="row">
        <div class="col-sm-8">
            <h1>
            <?php if(Yii::$app->user->identity->type == 'Marketing'): ?>
                <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['selfcustomer/view', 'id' => $model->perusahaan], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>
                Detail Penawaran <b>#<?= $model->no_surat ?></b>
            </h1>
        </div>
        <div class="col-sm-4">
            <p>
            <?php if(Yii::$app->user->identity->type == 'Marketing'): ?>
                <?php if($model->status === 'Pending'): ?>
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Hapus data ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?php endif; ?>
            <?php elseif(Yii::$app->user->identity->type == 'Administrator'): ?>
                <?= Html::a('<i class="fa fa-fw fa-print"></i> Cetak', ['print', 'id' => $model->id], ['target'=>'_blank','class' => 'btn btn-success']) ?>
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Hapus data ini ?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
            </p>
        </div>
    </div>
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'label' => 'Waktu',
              'value' => function($data){
                return $data->tanggal.' '.$data->waktu;
              }
            ],
            'no_surat',
            [
              'attribute'=>'perusahaan',
              'format' => 'raw',
              'value'=>function($data){
                if(Yii::$app->user->identity->type == 'Marketing'){
                    return Html::a($data->customer->perusahaan, ['selfcustomer/view', 'id' => $data->perusahaan]);
                }else{
                    return Html::a($data->customer->perusahaan, ['customer/view', 'id' => $data->perusahaan]);
                }
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
