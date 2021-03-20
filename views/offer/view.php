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
        <div class="col-sm-9">
            <h1>
            <?php if(Yii::$app->user->identity->type == 'Marketing'): ?>
                <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['selfcustomer/view', 'id' => $model->perusahaan], ['class' => 'btn btn-success']) ?> Detail Penawaran <b>#<?= $model->no_surat ?></b>
            <?php else: ?>
                <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['customer/view', 'id' => $model->perusahaan], ['class' => 'btn btn-success']) ?> Detail Penawaran <b>#<?= $model->no_surat ?></b>
            <?php endif; ?>
            </h1>
        </div>
        <div class="col-sm-3">
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
            <?php else: ?>
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
