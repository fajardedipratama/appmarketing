<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */

$this->title = 'PURCHASE ORDER';
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-order-view">
<div class="row">
    <div class="col-sm-7">
        <h1><b><?= Html::encode($this->title) ?></b></h1>
        <h4><?= $model->customer->perusahaan.' - '.$model->no_po ?></h4>
    </div>
<?php if(Yii::$app->user->identity->type != 'Marketing'): ?>
    <div class="col-sm-5">
        <!-- tombol admin -->
    <?php if($model->status === 'Pending'): ?>
        <?= Html::a('<i class="fa fa-fw fa-check-square-o"></i> Setuju', ['accpo', 'id' => $model->id], ['class' => 'btn btn-success','data' => ['confirm' => 'Setujui PO ?','method' => 'post']]) ?>
        <button class="btn btn-danger" data-toggle="modal" data-target="#tolak-po"><i class="fa fa-fw fa-remove"></i> Tolak</button>
    <?php elseif($model->status === 'Disetujui'): ?>
        <?= Html::a('<i class="fa fa-fw fa-truck"></i> Terkirim', ['sendpo', 'id' => $model->id], ['class' => 'btn btn-success','data' => ['confirm' => 'Barang Terkirim ?','method' => 'post']]) ?>
    <?php  elseif($model->status === 'Terkirim'):  ?>
        <?= Html::a('<i class="fa fa-fw fa-money"></i> Terbayar', ['paidpo', 'id' => $model->id], ['class' => 'btn btn-success','data' => ['confirm' => 'PO Terbayar Lunas ?','method' => 'post']]) ?>
    <?php endif; ?>
        <!-- tombol admin -->
        <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => ['confirm' => 'Hapus data ini ?','method' => 'post',],
        ]) ?>
    </div>
<?php elseif(Yii::$app->user->identity->type == 'Marketing' && $model->status == 'Pending'): ?>
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
        <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Hapus data ini ?','method' => 'post',],
        ]) ?>
    </div>
<?php endif; ?>
</div>

    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'perusahaan',
                'value'=>($model->customer)?$model->customer->perusahaan:'-',
            ],
            [
                'attribute'=>'sales',
                'value'=>($model->karyawan)?$model->karyawan->nama:'-',
            ],
            'no_po',
            ['attribute'=>'tgl_po','value'=>date('d/m/Y',strtotime($model->tgl_po))],
            ['attribute'=>'tgl_kirim','value'=>date('d/m/Y',strtotime($model->tgl_kirim))],
            'alamat',
            'alamat_kirim',
            'purchasing',
            'no_purchasing',
            'keuangan',
            'no_keuangan',
            'volume',
            'termin',
            'harga',
            'cashback',
            'pajak',
            'pembayaran',
            'catatan',
            'status',
            'alasan_tolak',
        ],
    ]) ?>
    </div>

    <div class="modal fade" id="tolak-po"><div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Tolak PO</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formtolak', ['model' => $model]) ?>
            </div>
        </div>
    </div></div>

</div>
