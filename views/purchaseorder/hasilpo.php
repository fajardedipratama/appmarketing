<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PurchaseOrder;

$volume = PurchaseOrder::find()->where(['status'=>'Terkirim'])->orWhere(['status'=>'Terbayar-Selesai'])->sum('volume');
$finance = PurchaseOrder::find()->where(['status'=>'Terbayar-Selesai'])->all();

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-order-view">

    <div class="box-body">
    <table class="table table-bordered">
        <tr>
            <th>Total Volume</th>
            <td><?= $volume/1000 ?> KL</td>
     	</tr>
     	<tr>
            <th>Total Terbayar (Rp)</th>
            <td>
            	<?php foreach($finance as $total): ?>
            		<?= $total['harga']*$total['volume'] ?>
            	<?php endforeach ?>	
            </td>
     	</tr>
     	<tr>
            <th>Total Belum Bayar (Rp)</th>
            <td>112231111121</td>
     	</tr>
     	<tr>
            <th>Total Cashback (Rp)</th>
            <td>112231111121</td>
     	</tr>
    </table>
    </div>
</div>
<div class="modal fade" id="hasilpo"><div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><b>Hasil Purchase Order</b></h4>          
    </div>
    <div class="modal-body">
      <!-- <?= $this->render('hasilpo') ?> -->
    </div>
  </div>
</div></div>