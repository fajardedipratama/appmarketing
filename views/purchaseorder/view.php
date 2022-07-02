<?php
use app\models\PurchaseOrder;
use app\models\PurchaseOrderPaid;
use app\models\City;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */

$paid = PurchaseOrderPaid::find()->where(['purchase_order_id'=>$model->id])->orderBy(['paid_date'=>SORT_DESC])->all();
$paid_done = PurchaseOrderPaid::find()->where(['purchase_order_id'=>$model->id])->sum('amount');

function termin_value($value){
    if($value=='Cash On Delivery'){
        return 0;
    }elseif($value=='Cash Before Delivery'){
        return 0;
    }elseif($value=='Tempo 7 Hari'){
        return 100;
    }elseif($value=='Tempo 14 Hari'){
        return 200;
    }elseif($value=='Tempo 21 Hari'){
        return 300;
    }elseif($value=='Tempo 30 Hari'){
        return 400;
    }
}
function cashback_value($value){
    if($value){
        return ' + Cashback '.$value;
    }
}

function round_up($number, $precision = 2)
{
    $fig = pow(10, $precision);
    return (ceil($number * $fig) / $fig);
}

$this->title = 'PURCHASE ORDER';
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-order-view">
<div class="row">
    <div class="col-sm-7">
        <h1>
            <b><?= Html::encode($this->title) ?></b>
        </h1>
        <h4><?= $model->no_po ?></h4>
    <?php if(($model->range_paid != NULL || $model->range_paid == 0) && $model->status === 'Terbayar-Selesai'): ?>
        <p style="font-style: italic;">Kirim-Bayar = <?= $model->range_paid ?> hari 
        <?php if(Yii::$app->user->identity->type != 'Marketing'): ?>
            <?= Html::a('<i class="fa fa-fw fa-refresh"></i>', ['calculaterange', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']) ?>
        <?php endif ?>
        </p>
    <?php endif ?>
    </div>
<?php if(Yii::$app->user->identity->type == 'Manajemen'): ?>
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
    <?php if($model->status === 'Pending'): ?>
        <?= Html::a('<i class="fa fa-fw fa-check-square-o"></i> Setuju', ['accpo', 'id' => $model->id], ['class' => 'btn btn-success','data' => ['confirm' => 'Setujui PO ?','method' => 'post']]) ?>
        <button class="btn btn-danger" data-toggle="modal" data-target="#tolak-po"><i class="fa fa-fw fa-remove"></i> Tolak</button>
    <?php endif ?>
    </div>

<?php elseif(Yii::$app->user->identity->type == 'Administrator'): ?>
    <div class="col-sm-1"></div>
    <div class="col-sm-4">
    <?php if($model->status === 'Disetujui'): ?>
        <div class="btn-group">
            <button type="button" class="btn btn-success"><i class="fa fa-fw fa-truck"></i> Kirim</button>
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <?= Html::a('<i class="fa fa-fw fa-check"></i> Terkirim', ['sendpo', 'id' => $model->id], ['data' => ['confirm' => 'Barang Terkirim ?','method' => 'post']]) ?>
                </li>
                <li>
                    <?= Html::a('<i class="fa fa-fw fa-times"></i> Batal Kirim', ['dontsendpo', 'id' => $model->id], ['data' => ['confirm' => 'Barang Batal Kirim ?','method' => 'post']]) ?>
                </li>
            </ul>
        </div>
        <?= Html::a('<i class="fa fa-fw fa-print"></i> Print', ['print', 'id' => $model->id], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
        <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?php  elseif($model->status === 'Terkirim'):  ?>
        <?= Html::a('<i class="fa fa-fw fa-money"></i> Terbayar', ['paidpo', 'id' => $model->id], ['class' => 'btn btn-success','data' => ['confirm' => 'PO Terbayar Lunas ?','method' => 'post']]) ?>
        <?= Html::a('<i class="fa fa-fw fa-print"></i> Print', ['print', 'id' => $model->id], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
        <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?php endif ?>
    <?php if($model->status === 'Pending'): ?>
        <?= Html::a('<i class="fa fa-fw fa-pencil"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fa fa-fw fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Hapus data ini ?','method' => 'post',],
        ]) ?>
    <?php endif; ?>
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
            [
                'attribute'=>'jatuh_tempo',
                'value'=>function($data){
                    if($data->jatuh_tempo != NULL && $data->tgl_lunas != NULL){
                        return date('d/m/Y',strtotime($data->jatuh_tempo)).' (Lunas '.date('d/m/Y',strtotime($data->tgl_lunas)).')';
                    }elseif($data->jatuh_tempo != NULL){
                        return date('d/m/Y',strtotime($data->jatuh_tempo));
                    }
                }
            ],
            'alamat',
            [
                'attribute'=>'alamat_kirim',
                'value'=>function($data){
                    $city = City::find()->where(['id'=>$data->kota_kirim])->one();
                    return $data->alamat_kirim.' ('.$city['kota'].')';
                }
            ],
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
                'format'=>'raw',
                'value'=>function($data){
                    if($data->tgl_kirim>'2022-03-31'){
                        $ppn = ($data->harga*11)/100;
                    }else{
                        $ppn = ($data->harga*10)/100;
                    }
                    $pph = round_up(($data->harga*0.3)/100,2);
                    $include = $data->harga+$ppn+$pph;
                    $city = City::find()->where(['id'=>$data->kota_kirim])->one();
                  if($data->pajak==='PPN'){
                    if($data->tgl_po > '2021-11-15'){
                        return ($data->harga-termin_value($data->termin)-$city['oat']-$data->cashback).' + Termin '.termin_value($data->termin).' + OAT '.$city['oat'].cashback_value($data->cashback).' = <b>DPP '.$data->harga.'</b><br> PPN = '.$ppn.' ,PPH22 = '.$pph.'<br> Total = '.Yii::$app->formatter->asCurrency($include);
                    }else{
                        return ($data->harga-termin_value($data->termin)-$city['oat']-$data->cashback).' + Termin '.termin_value($data->termin).' + OAT '.$city['oat'].cashback_value($data->cashback).' = '.$data->harga;
                    }
                  }else{
                    return ($data->harga-termin_value($data->termin)-$city['oat']-$data->cashback).' + Termin '.termin_value($data->termin).' + OAT '.$city['oat'].cashback_value($data->cashback).' = '.$data->harga;
                  }
                    
                }
            ],
            'pajak',
            'cashback',
            'penalti',
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
            [
                'label'=>'Status Order',
                'attribute'=>'tgl_po',
                'value'=>function($data){
                    $check=PurchaseOrder::find()->where(['perusahaan'=>$data->perusahaan])->andWhere(['status'=>['Pending','Terkirim','Terbayar-Selesai']])->andWhere(['<=','tgl_po',$data->tgl_po])->count();
                    if($check > 1){
                        return "Repeat Order";
                    }else{
                        return "First Order";
                    }
                }
            ],
        ],
    ]) ?>
    </div>
    </div>
    
    <div class="tab-pane" id="paid">
    <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#paid-po"><i class="fa fa-fw fa-dollar"></i> Tambah Bayar</button>
    <?php endif ?>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Bank</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        <?php foreach($paid as $show_paid): ?>
            <tr>
                <td><?= date('d/m/Y',strtotime($show_paid['paid_date'])) ?></td>
                <td><?= Yii::$app->formatter->asCurrency($show_paid['amount']) ?></td>
                <td><?= $show_paid['bank'] ?></td>
                <td><?= $show_paid['note'] ?></td>
                <td>
                <?php if(Yii::$app->user->identity->type == 'Administrator'): ?>
                    <?= Html::a('<i class="fa fa-fw fa-pencil"></i>', ['purchaseorderpaid/update', 'id' => $show_paid['id']]) ?>
                    <?= Html::a('<i class="fa fa-fw fa-trash"></i>', ['purchaseorderpaid/delete', 'id' => $show_paid['id']], ['data' => ['confirm' => 'Hapus data ini ?','method' => 'post']]) ?>
                <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        <?php 
            if($model->tgl_kirim>'2022-03-31'){
                $ppn = ($model->harga*11)/100;
            }else{
                $ppn = ($model->harga*10)/100;
            }
            $pph = round_up(($model->harga*0.3)/100,2);
            if($model->pajak === 'PPN'){
                if($model->tgl_po > '2021-11-15'){
                    $total_tagihan = ($model->harga+$ppn+$pph+$model->penalti)*$model->volume;
                }else{
                    $total_tagihan = ($model->harga+$model->penalti)*$model->volume;
                }
            }else{
                $total_tagihan = ($model->harga+$model->penalti)*$model->volume;
            }
             
        ?>
            <tr>
                <th>Total Tagihan</th>
                <th><?= Yii::$app->formatter->asCurrency($total_tagihan); ?></th>
            </tr>
            <tr>
                <th>Total Terbayar</th>
                <th><?= Yii::$app->formatter->asCurrency($paid_done); ?></th>
            </tr>
            <tr>
                <th>Sisa</th>
                <th><?= Yii::$app->formatter->asCurrency($total_tagihan-$paid_done); ?></th>
            </tr>
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
