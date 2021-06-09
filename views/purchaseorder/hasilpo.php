<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PurchaseOrder;

if($_GET['range']=='all'){
    $kirim = PurchaseOrder::find()->where(['status'=>'Terkirim'])->orWhere(['status'=>'Terbayar-Selesai'])->sum('volume');
    $pending = PurchaseOrder::find()->where(['status'=>'Disetujui'])->sum('volume');
}else{
    $data = explode("x", $_GET['range']);
    $set_awal = $data[0];
    $set_akhir = $data[1];
    $kirim=PurchaseOrder::find()->where(['status'=>'Terkirim'])->orWhere(['status'=>'Terbayar-Selesai'])->andWhere(['between','tgl_kirim',$set_awal,$set_akhir])->sum('volume');
    $pending = PurchaseOrder::find()->where(['status'=>'Disetujui'])->andWhere(['between','tgl_kirim',$set_awal,$set_akhir])->sum('volume');
}

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */
$this->title = 'Hasil PO';
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-order-view">
<div class="row">
  <div class="col-sm-10">
    <h1><?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['index'], ['class' => 'btn btn-success']) ?> <?= Html::encode($this->title) ?></h1>
  <?php if($_GET['range']!='all'): ?>
    <h5><i><?= $set_awal.' / '.$set_akhir ?></i></h5>
  <?php endif; ?>
  </div>
  <div class="col-sm-2">
    <?= Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['hasilpo','range'=>'all'], ['class' => 'btn btn-warning']) ?>
    <button class="btn btn-success" data-toggle="modal" data-target="#search-po"><i class="fa fa-fw fa-search"></i> Cari</button>
  </div>
</div>

<div class="box"><div class="box-body"><div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Solar Terkirim</th>
            <td><?= $kirim/1000 ?> KL</td>
     	</tr>
        <tr>
            <th>Solar Belum Terkirim</th>
            <td><?= $pending/1000 ?> KL</td>
        </tr>
    </table>
</div></div></div>

    <div class="modal fade" id="search-po"><div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Pencarian</b></h4>          
            </div>
            <div class="modal-body">
              <?= $this->render('_formhasilpo', ['model'=>$model]) ?>
            </div>
        </div>
    </div></div>

</div>
