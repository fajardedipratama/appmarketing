<?php
use app\models\PurchaseOrderPaid;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */

$paid = PurchaseOrderPaid::find()->where(['purchase_order_id'=>$model->id])->all();

$this->title = 'PURCHASE ORDER';
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-order-view">
<div class="row">
    <div class="col-sm-7">
        <h1>
            <?php if($model->eksternal): ?>
                <i class="fa fa-fw fa-user-secret" title="Titipan"></i>
            <?php endif; ?>
            <b><?= Html::encode($this->title) ?></b>
        </h1>
        <h4><?= $model->no_po ?></h4>
    </div>
<?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
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
        <?= Html::a('<i class="fa fa-fw fa-print"></i> Print', ['print', 'id' => $model->id], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
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

<section class="content"><div class="nav-tabs-custom tab-success">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#detail" data-toggle="tab">Detail</a></li>
        <li><a href="#paid" data-toggle="tab">Pembayaran</a></li>
    </ul>

<div class="tab-content">
    <div class="active tab-pane" id="detail">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            [
                'attribute'=>'sales',
                'value'=>($model->karyawan)?$model->karyawan->nama:'-',
            ],
            ['attribute'=>'tgl_po','value'=>date('d/m/Y',strtotime($model->tgl_po))],
            ['attribute'=>'tgl_kirim','value'=>date('d/m/Y',strtotime($model->tgl_kirim))],
            'alamat',
            'alamat_kirim',
            [
                'attribute'=>'purchasing',
                'value'=>function($data){
                    return $data->purchasing.' - '.$data->no_purchasing;
                }
            ],
            [
                'attribute'=>'keuangan',
                'value'=>function($data){
                    return $data->keuangan.' - '.$data->no_keuangan;
                }
            ],
            'penerima',
            'volume',
            'termin',
            [
                'attribute'=>'harga',
                'value'=>function($data){
                    return $data->harga.' ('.$data->pajak.')';
                }
            ],
            'cashback',
            [
                'attribute'=>'pembayaran',
                'value'=>function($data){
                    if($data->bilyet_giro == 1){
                        return $data->pembayaran.' (& Backup BG)';
                    }else{
                        return $data->pembayaran;
                    }
                }
            ],
            'catatan',
            'status',
            'alasan_tolak',
        ],
    ]) ?>
    </div>
    </div>
    
    <div class="tab-pane" id="paid">
    <?php if(Yii::$app->user->identity->type != 'Marketing'): ?>
        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#paid-po"><i class="fa fa-fw fa-dollar"></i> Tambah Bayar</button>
    <?php endif ?>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Catatan</th>
            </tr>
        <?php foreach($paid as $show_paid): ?>
            <tr>
                <td><?= date('d/m/Y',strtotime($show_paid['paid_date'])) ?></td>
                <td><?= Yii::$app->formatter->asCurrency($show_paid['amount']) ?></td>
                <td><?= $show_paid['note'] ?></td>
            </tr>
        <?php endforeach ?>
          </table>
        </div>
    </div>
</div>
</div></section>

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

    <div class="modal fade" id="paid-po"><div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Pembayaran</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formbayar', ['model'=>$model,'modelpaid' => $modelpaid]) ?>
            </div>
        </div>
    </div></div>

</div>
