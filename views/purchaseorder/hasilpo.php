<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PurchaseOrder;

$volume_kirim = PurchaseOrder::find()->where(['status'=>'Terkirim'])->orWhere(['status'=>'Terbayar-Selesai'])->sum('volume');
$volume_pending = PurchaseOrder::find()->where(['status'=>'Disetujui'])->sum('volume');
$terbayar = Yii::$app->db->createCommand('SELECT SUM(harga*volume) AS total FROM id_purchase_order WHERE status="Terbayar-Selesai"')->queryAll();
$terkirim = Yii::$app->db->createCommand('SELECT SUM(harga*volume) AS total FROM id_purchase_order WHERE status="Terkirim"')->queryAll();
$cashback_lunas = Yii::$app->db->createCommand('SELECT SUM(cashback*volume) AS total FROM id_purchase_order WHERE status="Terbayar-Selesai"')->queryAll();
$cashback_pending = Yii::$app->db->createCommand('SELECT SUM(cashback*volume) AS total FROM id_purchase_order WHERE status="Terkirim"')->queryAll();

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-order-view">

    <div class="box-body">
    <table class="table table-bordered">
        <tr>
            <th>Solar Terkirim</th>
            <td><?= $volume_kirim/1000 ?> KL</td>
     	</tr>
        <tr>
            <th>Solar Belum Terkirim</th>
            <td><?= $volume_pending/1000 ?> KL</td>
        </tr>
     	<tr>
            <th>Total Terbayar (Rp)</th>
            <td>
            	<?php foreach($terbayar as $total): ?>
            		<?= Yii::$app->formatter->asCurrency($total['total']) ?>
            	<?php endforeach ?>	
            </td>
     	</tr>
     	<tr>
            <th>Total Belum Bayar (Rp)</th>
            <td>
                <?php foreach($terkirim as $total): ?>
                    <?= Yii::$app->formatter->asCurrency($total['total']) ?>
                <?php endforeach ?> 
            </td>
     	</tr>
     	<tr>
            <th>Cashback Terbayar (Rp)</th>
            <td>
                <?php foreach($cashback_lunas as $total): ?>
                    <?= Yii::$app->formatter->asCurrency($total['total']) ?>
                <?php endforeach ?> 
            </td>
     	</tr>
        <tr>
            <th>Cashback Belum Terbayar (Rp)</th>
            <td>
                <?php foreach($cashback_pending as $total): ?>
                    <?= Yii::$app->formatter->asCurrency($total['total']) ?>
                <?php endforeach ?> 
            </td>
        </tr>
    </table>
    </div>
</div>
