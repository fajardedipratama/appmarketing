<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PurchaseOrder;

$volume_kirim = PurchaseOrder::find()->where(['status'=>'Terkirim'])->orWhere(['status'=>'Terbayar-Selesai'])->sum('volume');
$volume_pending = PurchaseOrder::find()->where(['status'=>'Disetujui'])->sum('volume');
$terbayar = Yii::$app->db->createCommand('SELECT SUM(harga*volume) AS total FROM id_purchase_order WHERE status="Terbayar-Selesai"')->queryAll();
$terkirim = Yii::$app->db->createCommand('SELECT SUM(harga*volume) AS total FROM id_purchase_order WHERE status="Terkirim"')->queryAll();

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */
$this->title = 'Hasil PO';
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-order-view">
<h1><?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', ['index'], ['class' => 'btn btn-success']) ?> <?= Html::encode($this->title) ?></h1>
<div class="box"><div class="box-body"><div class="table-responsive">
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
    </table>
</div></div></div>

</div>
